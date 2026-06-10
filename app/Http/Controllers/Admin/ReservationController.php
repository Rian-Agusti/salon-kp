<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Reservation\CalculateDiscount;
use App\Actions\Reservation\GenerateReservationCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReservationStatusRequest;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with('user')->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('source') && $request->source != '') {
            $query->where('source', $request->source);
        }

        $reservations = $query->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $customers = User::role('customer')->orderBy('name')->get();
        $services = Service::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();
        $promotions = Promotion::where('is_active', true)->where('start_date', '<=', today())->where('end_date', '>=', today())->get();

        return view('admin.reservations.create', compact('customers', 'services', 'products', 'promotions'));
    }

    public function store(Request $request, CalculateDiscount $calculateDiscount)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'products' => 'nullable|array',
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'integer|min:1',
            'promotions' => 'nullable|array',
            'promotions.*' => 'exists:promotions,id',
            'notes' => 'nullable|string'
        ]);

        if (empty($request->services) && empty($request->products) && empty($request->promotions)) {
            return back()->withErrors(['general' => 'Harap pilih minimal satu layanan, produk, atau promo.'])->withInput();
        }

        $user = User::findOrFail($request->user_id);
        $reservationCode = GenerateReservationCode::generate();

        $reservation = DB::transaction(function () use ($request, $user, $reservationCode, $calculateDiscount) {
            $services = Service::whereIn('id', $request->services ?? [])->get();
            $productsInput = collect($request->products ?? [])->filter(fn($p) => isset($p['id']) && $p['quantity'] > 0);
            $products = Product::whereIn('id', $productsInput->pluck('id'))->get();
            $promotions = Promotion::whereIn('id', $request->promotions ?? [])->get();

            $totalPrice = $services->sum('price');

            foreach ($products as $product) {
                $qty = $productsInput->firstWhere('id', $product->id)['quantity'] ?? 1;
                $totalPrice += ($product->price * $qty);
            }

            if ($totalPrice >= 100000) {
                $user->member_until = now()->addYear();
                $user->save();
            }

            $user->refresh();
            $discountAmount = $calculateDiscount->execute($user, $totalPrice);

            $reservation = Reservation::create([
                'user_id' => $user->id,
                'reservation_code' => $reservationCode,
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'status' => 'completed', // Walk-in is instantly completed
                'source' => 'offline',
                'payment_status' => 'paid',
                'discount_amount' => $discountAmount,
                'notes' => $request->notes,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'customer_phone' => $user->phone,
            ]);

            foreach ($services as $service) {
                $reservation->reservationItems()->create([
                    'service_id' => $service->id,
                    'service_name' => $service->name,
                    'service_price' => $service->price,
                    'service_duration' => $service->duration_minutes,
                ]);
            }

            foreach ($products as $product) {
                $qty = $productsInput->firstWhere('id', $product->id)['quantity'] ?? 1;
                $reservation->reservationItems()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_quantity' => $qty,
                    'service_price' => $product->price * $qty, // We store total line price in service_price for sum logic
                    'service_duration' => 0,
                ]);
            }

            foreach ($promotions as $promo) {
                $reservation->reservationItems()->create([
                    'promotion_id' => $promo->id,
                    'promotion_name' => $promo->title,
                    'service_price' => 0, // Assuming promo has no direct price add, but could be adjusted
                    'service_duration' => 0,
                ]);
            }

            return $reservation;
        });

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservasi offline berhasil dibuat untuk ' . $user->name);
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'reservationItems']);

        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(UpdateReservationStatusRequest $request, Reservation $reservation)
    {
        $reservation->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Reservation status updated successfully.');
    }

    public function pdf(Reservation $reservation)
    {
        $reservation->load(['user', 'reservationItems']);
        $pdf = Pdf::loadView('reservations.pdf', compact('reservation'));

        return $pdf->download('reservation-'.$reservation->reservation_code.'.pdf');
    }
}

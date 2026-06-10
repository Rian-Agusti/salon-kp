<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Reservation\CalculateDiscount;
use App\Actions\Reservation\GenerateReservationCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $activeReservations = Reservation::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $completedReservations = Reservation::where('user_id', $user->id)
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $latestReservation = Reservation::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('customer.reservations.index', compact('activeReservations', 'completedReservations', 'latestReservation'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();
        $promotions = Promotion::where('is_active', true)->where('start_date', '<=', today())->where('end_date', '>=', today())->get();

        return view('customer.reservations.create', compact('services', 'products', 'promotions'));
    }

    public function store(StoreReservationRequest $request, CalculateDiscount $calculateDiscount)
    {
        $user = Auth::user();
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
                'status' => 'pending',
                'discount_amount' => $discountAmount,
                'notes' => $request->notes,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'customer_phone' => $user->phone,
            ]);

            foreach ($services as $service) {
                $reservation->reservationItems()->create([
                    'item_type' => 'service',
                    'service_id' => $service->id,
                    'service_name' => $service->name,
                    'service_price' => $service->price,
                    'service_duration' => $service->duration_minutes,
                    'quantity' => 1,
                ]);
            }

            foreach ($products as $product) {
                $qty = $productsInput->firstWhere('id', $product->id)['quantity'] ?? 1;
                $reservation->reservationItems()->create([
                    'item_type' => 'product',
                    'service_id' => null,
                    'service_name' => $product->name,
                    'service_price' => $product->price,
                    'service_duration' => 0,
                    'quantity' => $qty,
                ]);
            }

            foreach ($promotions as $promo) {
                $reservation->reservationItems()->create([
                    'item_type' => 'promotion',
                    'service_id' => null,
                    'service_name' => $promo->title,
                    'service_price' => 0,
                    'service_duration' => 0,
                    'quantity' => 1,
                ]);
            }

            return $reservation;
        });

        return redirect()->route('customer.reservations.success', $reservation->id)
            ->with('success', 'Reservation created successfully!');
    }

    public function show(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }
        $reservation->load('reservationItems');

        return view('customer.reservations.show', compact('reservation'));
    }

    public function success(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }
        $reservation->load('reservationItems');
        $setting = Setting::first();

        return view('customer.reservations.success', compact('reservation', 'setting'));
    }
}

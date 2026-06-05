<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReservationStatusRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use app\Actions\Reservation\GenerateReservationCode;


class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with('user')->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $reservations = $query->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'reservationItems']);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(UpdateReservationStatusRequest $request, Reservation $reservation)
    {
        $reservation->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Reservation status updated successfully.');
    }

    public function pdf(Reservation $reservation)
    {
        $reservation->load(['user', 'reservationItems']);
        $pdf = Pdf::loadView('reservations.pdf', compact('reservation'));
        return $pdf->download('reservation-' . $reservation->reservation_code . '.pdf');
    }
}

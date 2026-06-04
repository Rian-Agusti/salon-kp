<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = User::role('customer')->count();
        $totalReservations = Reservation::count();
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $todaysReservations = Reservation::whereDate('booking_date', Carbon::today())->count();

        $popularServices = ReservationItem::select('service_name', DB::raw('count(*) as count'))
            ->whereHas('reservation', function($q) {
                $q->whereIn('status', ['confirmed', 'completed']);
            })
            ->groupBy('service_name')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalReservations',
            'pendingReservations',
            'todaysReservations',
            'popularServices'
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $ttl = 300; // 5 minutes

        $totalCustomers = Cache::remember('admin.dashboard.total_customers', $ttl, function () {
            return User::role('customer')->count();
        });

        $totalReservations = Cache::remember('admin.dashboard.total_reservations', $ttl, function () {
            return Reservation::count();
        });

        $pendingReservations = Cache::remember('admin.dashboard.pending_reservations', $ttl, function () {
            return Reservation::where('status', 'pending')->count();
        });

        $today = Carbon::today()->toDateString();
        $todaysReservations = Cache::remember("admin.dashboard.today.{$today}", $ttl, function () {
            return Reservation::whereDate('booking_date', Carbon::today())->count();
        });

        $popularServices = Cache::remember('admin.dashboard.popular_services', $ttl, function () {
            return ReservationItem::select('service_name', DB::raw('count(*) as count'))
                ->whereHas('reservation', function ($q) {
                    $q->whereIn('status', ['confirmed', 'completed']);
                })
                ->groupBy('service_name')
                ->orderBy('count', 'desc')
                ->take(5)
                ->get()
                ->toArray();
        });

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalReservations',
            'pendingReservations',
            'todaysReservations',
            'popularServices'
        ));
    }
}

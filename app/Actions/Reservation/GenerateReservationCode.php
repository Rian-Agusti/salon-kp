<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use Carbon\Carbon;

class GenerateReservationCode
{
    public static function generate(): string
    {
        $today = Carbon::today();
        $dateString = $today->format('Ymd');

        $lastReservation = Reservation::whereDate('booking_date', $today)->orderBy('id', 'desc')->first();

        $counter = 1;
        if ($lastReservation && preg_match('/EEV-\d{8}-(\d{3})/', $lastReservation->reservation_code, $matches)) {
            $counter = intval($matches[1]) + 1;
        }

        return sprintf('EEV-%s-%03d', $dateString, $counter);
    }
}

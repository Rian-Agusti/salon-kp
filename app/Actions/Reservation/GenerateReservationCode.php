<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class GenerateReservationCode
{
    /**
     * Generate a unique reservation code with format EEV-YYYYMMDD-XXX
     */
    public static function generate(): string
    {
        $date = Carbon::now();
        $datePrefix = 'EEV-' . $date->format('Ymd') . '-';

        // Find the latest reservation code for today
        $latestReservation = Reservation::where('reservation_code', 'like', $datePrefix . '%')
            ->orderBy('reservation_code', 'desc')
            ->first();

        if (!$latestReservation) {
            $counter = 1;
        } else {
            // Extract the counter part (XXX) from the latest code
            $lastCode = $latestReservation->reservation_code;
            $counter = (int) Str::afterLast($lastCode, '-') + 1;
        }

        // Format the counter with leading zeros up to 3 digits
        $formattedCounter = str_pad((string)$counter, 3, '0', STR_PAD_LEFT);

        return $datePrefix . $formattedCounter;
    }
}

<?php

namespace App\Actions\Reservation;

use App\Models\User;
use Carbon\Carbon;

class CalculateDiscount
{
    /**
     * Calculate discount based on user membership and total price.
     *
     * @param User $user
     * @param float $totalPrice
     * @return float
     */
    public function execute(User $user, float $totalPrice): float
    {
        $discountAmount = 0;

        if ($user->member_until && $user->member_until->gte(today())) {
            if ($user->birth_date && Carbon::parse($user->birth_date)->isBirthday()) {
                $discountAmount = $totalPrice * 0.5;
            } else {
                $discountAmount = $totalPrice * 0.05;
            }
        }

        return $discountAmount;
    }
}

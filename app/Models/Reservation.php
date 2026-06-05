<?php

namespace App\Models;

use App\Enums\ReservationStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'reservation_code',
        'booking_date',
        'booking_time',
        'status',
        'notes',
        'customer_name',
        'customer_email',
        'customer_phone',
    ];

    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
            'status' => ReservationStatusEnum::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservationItems()
    {
        return $this->hasMany(ReservationItem::class);
    }
}

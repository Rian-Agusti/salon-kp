<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationItem extends Model
{
    protected $fillable = [
        'reservation_id',
        'service_id',
        'service_name',
        'service_price',
        'service_duration',
    ];

    protected function casts(): array
    {
        return [
            'service_price' => 'decimal:2',
            'service_duration' => 'integer',
        ];
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class)->withTrashed();
    }
}

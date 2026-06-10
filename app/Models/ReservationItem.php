<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationItem extends Model
{
    protected $fillable = [
        'reservation_id',
        'item_type',
        'service_id',
        'service_name',
        'service_price',
        'service_duration',
        'product_id',
        'product_name',
        'product_quantity',
        'promotion_id',
        'promotion_name',
    ];

    protected $casts = [
        'service_price' => 'decimal:2',
        'service_duration' => 'integer',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}

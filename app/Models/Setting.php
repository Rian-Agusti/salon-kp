<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'salon_name',
        'address',
        'phone',
        'email',
        'instagram',
        'facebook',
        'tiktok',
        'google_maps',
        'opening_hour',
        'closing_hour',
    ];
}

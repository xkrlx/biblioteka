<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arrear extends Model
{
    protected $fillable = [
        'booking_id',
        'user_id',
        'cost',
        'days',
        'paid_status',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'date_from',
        'date_to',
        'end_date',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'book_id',
        'title',
        'year',
        'author',
        'publisher',
        'pages',
        'description',
        'photo',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
      'name','active'
    ];
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

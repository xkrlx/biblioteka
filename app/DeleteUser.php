<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeleteUser extends Model
{
    protected $fillable = [
        'reason',
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

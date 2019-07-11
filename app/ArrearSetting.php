<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArrearSetting extends Model
{
    protected $fillable = [
        'days',
        'cost_per_day'
    ];
}

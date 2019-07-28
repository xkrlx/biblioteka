<?php

use Illuminate\Database\Seeder;
use App\ArrearSetting;

class PenaltiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArrearSetting::create([
            'days'=>14,
            'cost_per_day'=>0.41,
        ]);
        ArrearSetting::create([
            'days'=>30,
            'cost_per_day'=>0.83,
        ]);
        ArrearSetting::create([
            'days'=>90,
            'cost_per_day'=>1.56,
        ]);
    }
}

<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i=0;$i<=50;$i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'pesel'=> 99121207150+$i,
                'active' => false,
            ]);
        }

        User::create([
           'name'=>'user',
           'email' => 'user@example.com',
           'password'=>bcrypt('user1234'),
            'pesel' =>'12345678901',
            'active'=>true,
        ]);
    }
}

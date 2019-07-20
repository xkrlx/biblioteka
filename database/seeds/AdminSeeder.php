<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'Admin',
            'email'=>'admin@test.com',
            'password'=>bcrypt('password'),
            'role_id'=>1,
        ]);

        Admin::create([
            'name'=>'bibliotekarz',
            'email'=>'user@example.com',
            'password'=>bcrypt('user1234'),
            'role_id'=>2,
        ]);

        Admin::create([
            'name'=>'starzysta',
            'email'=>'user2@example.com',
            'password'=>bcrypt('user1234'),
            'role_id'=>3,
        ]);
    }
}

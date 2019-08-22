<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i=1;$i<=100;$i++) {
            Book::create([
                'book_id' => $i,
                'title' => $faker->city,
                'year' => $faker->year,
                'author' => $faker->name,
                'publisher' => $faker->state,
                'pages' => $faker->randomDigit,
                'description' => $faker->realText(),
                'category_id' => 1,

            ]);
        }
    }
}

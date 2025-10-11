<?php

namespace Database\Seeders;

use App\Models\RelatedNewsSite;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RelatedNewsSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               $faker = \Faker\Factory::create();
            for ($i = 0; $i < 5; $i++) {
                RelatedNewsSite::create([
                    "name"=> $faker->sentence(1),
                    "url"=> $faker->url(),
            ]);
        }
    }
}

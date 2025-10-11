<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['cate 1','cate 2','cate 3','cate 4',];

        $date = fake()->date('Y-m-d h:m:s');

        foreach ($data as $name) {
            Category::create([
                'name'=> $name,
                'slug'=> Str::slug($name),
                'status'=> 1,
                'created_at' => $date,
                'updated_at'=> $date,

            ]);
        }




    }
}

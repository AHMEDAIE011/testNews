<?php

namespace Database\Seeders;

use App\Models\Admin;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::Create([
            "name"=> "admin",
            "username"=> "ahmed ali ",
            "email"=> "admin@gmail.com",
            "password"=> bcrypt("password"),
        ]);
    }
}

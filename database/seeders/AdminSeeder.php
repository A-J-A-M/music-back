<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class AdminSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        DB::table('t_admins')->insert([
            'email' => $faker->firstName().'@gmail.com',
            'password' => Hash::make('password') 
        ]);
    }
}

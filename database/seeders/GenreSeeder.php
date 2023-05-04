<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_genres')->insert([
            'name' => "Blues"
        ]);
        DB::table('c_genres')->insert([
            'name' => "Jazz"
        ]);
        DB::table('c_genres')->insert([
            'name' => "Ponk"
        ]);
    }
}

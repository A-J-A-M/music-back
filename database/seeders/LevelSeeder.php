<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_levels')->insert([
            'difficulty' => 1,
            'name' => "Fácil"
        ]);
        DB::table('c_levels')->insert([
            'difficulty' => 2,
            'name' => "Media"
        ]);
        DB::table('c_levels')->insert([
            'difficulty' => 3,
            'name' => "Difícil"
        ]);
    }
}

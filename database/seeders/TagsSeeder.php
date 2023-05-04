<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_tags')->insert([
            'name' => "Arpegios"
        ]);
        DB::table('c_tags')->insert([
            'name' => "Escalas"
        ]);
        DB::table('c_tags')->insert([
            'name' => "Lectura rápida"
        ]);
        DB::table('c_tags')->insert([
            'name' => "Lectura extensa"
        ]);
        DB::table('c_tags')->insert([
            'name' => "Improvisación"
        ]);
    }
}

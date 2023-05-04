<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_types')->insert([
            'name' => "Video"
        ]);
        DB::table('c_types')->insert([
            'name' => "Documento"
        ]);
        DB::table('c_types')->insert([
            'name' => "Texto"
        ]);
    }
}

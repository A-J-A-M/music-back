<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Crypt;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $id_types = DB::table('c_types')->pluck('id');
        $id_levels = DB::table('c_levels')->pluck('id');
        $id_genres = DB::table('c_genres')->pluck('id');
        $id_admins = DB::table('t_admins')->pluck('id');
        for ($i = 0; $i < 10; $i++) {
            $id = DB::table('t_media')->insertGetId([
                'title' => $faker->words(3, true),
                'url' => 'https://www.youtube.com/watch?v='. implode('', $faker->randomElements(['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'], 10)),
                'outside' => true,
                'description' => $faker->words(10, true),
                'type_id' => $faker->randomElement($id_types),
                'level_id' => $faker->randomElement($id_levels),
                'admin_id' => $faker->randomElement($id_admins),
                'genre_id' => $faker->randomElement($id_genres)
            ]);
            DB::table('t_media')
                ->where('id', $id)
                ->update(['encrypt_id' => Crypt::encryptString($id)]);
        }
    }
}

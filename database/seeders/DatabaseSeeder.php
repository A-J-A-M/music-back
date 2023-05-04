<?php

namespace Database\Seeders;

use App\Models\MediaTags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            LevelSeeder::class,
            GenreSeeder::class,
            TypesSeeder::class,
            TagsSeeder::class,
            MediaSeeder::class,
            MediaTagSeeder::class
        ]);
        $lista = ['t_admins', 'c_levels', 'c_genres', 'c_types', 'c_tags'];

        // Put an encrypt id in every table
        foreach ($lista as $objeto){
            $tabla = DB::table($objeto)->get();

            foreach ($tabla as $row){
                $id = $row->id;
                $encr = Crypt::encryptString($id);
    
                $affected = DB::table($objeto)
                  ->where('id', $id)
                  ->update(['encrypt_id' => $encr]);
            }
        }
    }
}

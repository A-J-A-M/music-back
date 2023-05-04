<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class MediaTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $media = Media::all();
        $tags = Tag::all();


        // attach random tags to each media
        $media->each(function ($media) use ($tags) {
            $media->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
        });

        $tabla = DB::table('t_media_tags')->get();

        foreach ($tabla as $row){
            $id = $row->id;
            $encr = Crypt::encryptString($id);

            $affected = DB::table('t_media_tags')
              ->where('id', $id)
              ->update(['encrypt_id' => $encr]);
        }
    }
}

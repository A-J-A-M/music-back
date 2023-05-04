<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Genre;
use App\Models\Level;
use App\Models\Media;
use App\Models\MediaTags;
use App\Models\Tag;
use App\Models\Type;
use App\Validations\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function mediaValidation($request, $tipo)
    {
        $validator["status"] = false;
        if (!Type::find($request->type_id)) {
            $validator["status"] = true;
            $validator["message"] = "Id de tipo no existe: " . $request['type_id'];
        }
        if (!Admin::find($request->admin_id)) {
            $validator["status"] = true;
            $validator["message"] = "Id de admin no existe: " . $request['admin_id'];
        }
        if (!Level::find($request->level_id)) {
            $validator["status"] = true;
            $validator["message"] = "Id de nivel no existe: " . $request['level_id'];
        }
        if (!Genre::find($request->genre_id)) {
            $validator["status"] = true;
            $validator["message"] = "Id de género no existe: " . $request['genre_id'];
        }
        if (!Tag::find($request->tag_id)) {
            $validator["status"] = true;
            $validator["message"] = "Id de tag no existe: " . $request['tag_id'];
        }
        return $validator;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // $media = Media::all();
            $media = Media::with('level')->get();
            return Validations::responseGen(1, "lectura", $media, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0, "lectura", $e->getMessage(), "500");
        }
    }

    public function filter($media, $array)
    {
        try {
            if ($array == []) {
                return $media;
            }
            $newMedia = [];
            for ($i = 0; $i < count($array); $i++) {
                foreach ($media as $med) {
                    if (intval($med->level_id) == intval($array[$i])) {
                        $newMedia[] = $med;
                    }
                }
            }
            return $newMedia;
        } catch (\Exception $e) {
            return Validations::responseGen(0, "lectura", $e->getMessage(), "500");
        }
    }

    public function indexGet($text, Request $request)
    {
        try {
            // $typesId = DB::table('c_types')->whereIn('name', $types)->pluck('id');
            // $levelsId = DB::table('c_levels')->whereIn('name', $levels)->pluck('id');
            // return $request;

            // $media = DB::table('t_media')->where('title', 'like', '%' . $text . '%')
            //     ->orWhere('description', 'like', '%' . $text . '%')->get();
            // ->orWhereIn('type_id', $typesId)
            // ->orWhereIn('level_id', $levelsId);
            // $media = DB::table('t_media')
            //     ->leftJoin('c_levels', 't_media.level_id', '=', 'c_levels.id')
            //     ->where('title', 'like', '%' . $text . '%')
            //     ->orWhere('description', 'like', '%' . $text . '%')
            //     ->select('t_media.*', 'c_levels.name as level_name')
            //     ->get();
            $media = Media::leftJoin('c_levels', 't_media.level_id', '=', 'c_levels.id')
                ->where('title', 'like', '%' . $text . '%')
                ->orWhere('description', 'like', '%' . $text . '%')
                ->select('t_media.*', 'c_levels.name as level_name')
                ->get()
                ->toArray();
            // $media = $this->filter($media, $request->levels);

            $media = Media::hydrate($media)->load('level');

            return Validations::responseGen(1, "lectura", $media, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0, "lectura", $e->getMessage(), "500");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:20|unique:t_media',
                'url' => 'required|max:255|unique:t_media',
                'outside' => 'required|boolean',
                'description' => 'required|max:100',
                'type_id' => 'required|max:100|numeric',
                'level_id' => 'required|max:100|numeric',
                'admin_id' => 'required|max:100|numeric',
                'genre_id' => 'required|max:100|numeric',
                'tag_id' => 'required|max:100|numeric',
            ]);
            if ($validator->fails()) {
                return Validations::responseGen(0, "inserción", $validator->errors(), "400");
            }
            $val = $this->mediaValidation($request, "inserción");
            if ($val["status"]) {
                return Validations::responseGen(0, "inserción", $val["message"], "400");
            }

            $media = Media::create($request->all());
            $media->encrypt_id = Crypt::encryptString($media->id);
            $media->save();

            $data_mt = [
                "media_id" => $media->id, "tag_id" => $request->tag_id
            ];
            $media_tag = MediaTags::create($data_mt);
            $media_tag->encrypt_id = Crypt::encryptString($media_tag->id);
            $media_tag->save();

            return Validations::responseGen(1, "inserción", $media, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0, "inserción", $e->getMessage(), "500");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $encrypt_id)
    {
        try {
            $id = Crypt::decryptString($encrypt_id);
            if (!$media = Media::find($id)) {
                return Validations::responseGen(0, "eliminación", $id, "400");
            }
            if (!$media_tag = MediaTags::find($id)) {
                $id_array = [$id];
                $media_tag = MediaTags::where('media_id', $id_array)->delete();
            }

            $media->delete();
            return Validations::responseGen(1, "eliminación", $media, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0, "eliminación", $e->getMessage(), "500");
        }
    }
}

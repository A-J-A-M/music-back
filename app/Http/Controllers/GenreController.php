<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Validations\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $genres =   Genre::all();
            return Validations::responseGen(1,"lectura", $genres, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0,"lectura", $e->getMessage(), "500");
        }
        
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
                'name' => 'required|max:255|unique:c_genres',
            ]);
            if ($validator->fails()) {
                return Validations::responseGen(0, "inserción", $validator->errors(), "400");
            }
    
            $genre = Genre::create($request->all());
            $genre->encrypt_id = Crypt::encryptString($genre->id);
            $genre->save();
            return Validations::responseGen(1,"inserción", $genre, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0, "inserción", $e->getMessage(), "500");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genres
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypt_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|unique:c_genres',
            ]);
            if ($validator->fails()) {
                return Validations::responseGen(0, "actualización", $validator->errors(), "400");
            }

            $id = Crypt::decryptString($encrypt_id);
            if (!$genre = Genre::find($id)) {
                return Validations::responseGen(0,"actualización", $id, "400");
            }
            
            $genre->update($request->all());
            return Validations::responseGen(1,"actualización", $genre, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0,"actualización", $e->getMessage(), "500");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $levels
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $encrypt_id)
    {
        //forceDelete() ==> elimina permanentemente
        try {
            $id = Crypt::decryptString($encrypt_id);
            if (!$genre = Genre::find($id)) {
                return Validations::responseGen(0,"eliminación", $id, "400");
            }

            $genre->delete();
            return Validations::responseGen(1,"eliminación", $genre, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0,"eliminación", $e->getMessage(), "500");
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Validations\Validations;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $levels = Level::all();
            return Validations::responseGen(1,"lectura", $levels, "200");
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
                'difficulty' => 'required|numeric',
                'name' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return Validations::responseGen(0, "inserción", $validator->errors(), "400");
            }
    
            $level = Level::create($request->all());
            $level->encrypt_id = Crypt::encryptString($level->id);
            $level->save();
            return Validations::responseGen(1,"inserción", $level, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0, "inserción", $e->getMessage(), "500");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $levels
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypt_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'difficulty' => 'required|numeric',
                'name' => 'required|max:255',
            ]);
            if ($validator->fails()) {
                return Validations::responseGen(0, "actualización", $validator->errors(), "400");
            }

            $id = Crypt::decryptString($encrypt_id);
            if (!$level = Level::find($id)) {
                return Validations::responseGen(0,"actualización", $id, "400");
            }
            
            $level->update($request->all());
            return Validations::responseGen(1,"actualización", $level, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0,"actualización", $e->getMessage(), "500");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $levels
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $encrypt_id)
    {
        //forceDelete() ==> elimina permanentemente
        try {
            $id = Crypt::decryptString($encrypt_id);
            if (!$level = Level::find($id)) {
                return Validations::responseGen(0,"eliminación", $id, "400");
            }

            $level->delete();
            return Validations::responseGen(1,"eliminación", $level, "200");
        } catch (\Exception $e) {
            return Validations::responseGen(0,"eliminación", $e->getMessage(), "500");
        }
    }
}

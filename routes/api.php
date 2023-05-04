<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix"=>"v1"], function(){
    Route::resource('level', LevelController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('type', TypeController::class);
    Route::resource('tag', TagController::class);
    Route::resource('media', MediaController::class);

    Route::post('media/search/{text}', [MediaController::class, 'indexGet']);
});

<?php

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


Route::apiResource('name', '\App\Http\Controllers\NameController');

Route::post('hotels','\App\Http\Controllers\NameController@store');

Route::get('amenities','App\Http\Controllers\NameController@showByAmenities');

Route::get('names','App\Http\Controllers\NameController@showByNames');

Route::get('prices','App\Http\Controllers\RoomController@showByPrices');

Route::get('bed_sizes','App\Http\Controllers\RoomController@showByBed');

Route::get('names','App\Http\Controllers\NameController@showByLocations');



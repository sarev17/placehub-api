<?php

use App\Http\Controllers\PlaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#######################################
######## API Routes for places ########
#######################################

Route::resource('places', PlaceController::class);
Route::get('places/search/{name}',[PlaceController::class,'search']);

<?php

use Illuminate\Support\Facades\Route;
use Modules\Ambulance\Http\Controllers\AmbulanceController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/
//
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('ambulance',[AmbulanceController::class,'index']);
    Route::post('ambulance',[AmbulanceController::class,'store']);
    Route::get('ambulance/{ambulance}',[AmbulanceController::class,'show']);
    Route::put('ambulance/{ambulance}',[AmbulanceController::class,'update']);
    Route::patch('ambulance/{ambulance}',[AmbulanceController::class,'isAvailable']);
    Route::delete('ambulance',[AmbulanceController::class,'destroy']);
});


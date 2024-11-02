<?php

use Illuminate\Support\Facades\Route;
use Modules\Doctor\Http\Controllers\DoctorController;
use Modules\Doctor\Http\Controllers\ShiftController;

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
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('storeShift',[ShiftController::class,'store']);
    Route::get('indexShift/{month}',[ShiftController::class,'index']);
    Route::get('showShift/{shift}',[ShiftController::class,'show']);
    Route::post('updateShift/{shift}',[ShiftController::class,'update']);
    Route::delete('deleteShift/{shift}',[ShiftController::class,'destroy']);
    Route::delete('deleteShiftsOfYear/{year}',[ShiftController::class,'destroyShiftsOfYear']);
});



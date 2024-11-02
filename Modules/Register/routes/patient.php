<?php

use Illuminate\Support\Facades\Route;
use Modules\Register\Http\Controllers\PatientController;
use Modules\Register\Http\Controllers\RegisterController;

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
    Route::get('patient', [PatientController::class,'index']);
    Route::post('patient', [PatientController::class,'store']);
    Route::get('patient/{patient}', [PatientController::class,'show']);
    Route::patch('patient/{patient}', [PatientController::class,'update']);
    Route::delete('patient/{patient}', [PatientController::class,'destroy']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\PatientTestController;

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
    Route::get('patientTest', [PatientTestController::class,'index']);
    Route::post('patientTest', [PatientTestController::class,'store']);
    Route::get('patientTest/{PatientTest}', [PatientTestController::class,'show']);
    Route::patch('patientTest/{PatientTest}', [PatientTestController::class,'update']);
    Route::delete('patientTest/{PatientTest}', [PatientTestController::class,'destroy']);
    Route::get('showPatientTest/{patient}', [PatientTestController::class,'showPatientTest']);
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Register\Http\Controllers\AdmissionController;
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
    Route::get('admission', [AdmissionController::class,'index']);
    Route::post('admission', [AdmissionController::class,'store']);
    Route::get('admission/{admission}', [AdmissionController::class,'show']);
    Route::get('showPatientAdmission/{patient}', [AdmissionController::class,'showPatientAdmission']);
    Route::get('PatientLastAdmission/{patient}', [AdmissionController::class,'PatientLastAdmission']);
    Route::get('patientMovement/{admission}', [AdmissionController::class,'patientMovement']);
    Route::patch('PatientDischarge/{admission}', [AdmissionController::class,'PatientDischarge']);
});

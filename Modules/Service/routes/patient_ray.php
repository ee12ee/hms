<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\PatientRayController;

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
    Route::get('patientRay', [PatientRayController::class,'index']);
    Route::post('patientRay', [PatientRayController::class,'store']);
    Route::get('patientRay/{PatientRay}', [PatientRayController::class,'show']);
    Route::patch('patientRay/{PatientRay}', [PatientRayController::class,'update']);
    Route::delete('patientRay/{PatientRay}', [PatientRayController::class,'destroy']);
    Route::get('showPatientRay/{Patient}', [PatientRayController::class,'showPatientRays']);
});

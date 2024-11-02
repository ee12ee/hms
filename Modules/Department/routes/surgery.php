<?php

use Illuminate\Support\Facades\Route;
use Modules\Department\Http\Controllers\DepartmentController;
use Modules\Department\Http\Controllers\SurgeryController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('surgery', [SurgeryController::class,'index']);
    Route::post('surgery', [SurgeryController::class,'store']);
    Route::get('surgery/{surgery}', [SurgeryController::class,'show']);
    Route::patch('surgery/{surgery}', [SurgeryController::class,'update']);
    Route::delete('surgery/{surgery}', [SurgeryController::class,'destroy']);
});

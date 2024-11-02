<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\ServiceController;
use Modules\Service\Http\Controllers\RayController;

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
    Route::get('ray', [RayController::class,'index']);
    Route::post('ray', [RayController::class,'store']);
    Route::get('ray/{ray}', [RayController::class,'show']);
    Route::patch('ray/{ray}', [RayController::class,'update']);
    Route::delete('ray/{ray}', [RayController::class,'destroy']);
});

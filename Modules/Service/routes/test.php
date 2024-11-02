<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\ServiceController;
use Modules\Service\Http\Controllers\TestController;

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
    Route::get('test', [TestController::class,'index']);
    Route::post('test', [TestController::class,'store']);
    Route::get('test/{test}', [TestController::class,'show']);
    Route::patch('test/{test}', [TestController::class,'update']);
    Route::delete('test/{test}', [TestController::class,'destroy']);
});

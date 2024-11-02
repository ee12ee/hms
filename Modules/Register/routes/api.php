<?php

use Illuminate\Support\Facades\Route;
use Modules\Department\Http\Controllers\RoomController;
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
    // Route::apiResource('register', RegisterController::class)->names('register');
});

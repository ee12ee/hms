<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\InspectionController;
use Modules\Service\Http\Controllers\ServiceController;

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
Route::middleware(['auth:sanctum'])->apiResource('inspections',InspectionController::class);


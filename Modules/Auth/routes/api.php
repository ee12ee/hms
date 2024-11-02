<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\Auth\EmailVerificationNotificationController;
use Modules\Auth\Http\Controllers\Auth\PasswordResetLinkController;
use Modules\Auth\Http\Controllers\Auth\AuthenticatedSessionController;
use Modules\Auth\Http\Controllers\Auth\RegisteredUserController;
use Modules\Auth\Http\Controllers\Auth\NewPasswordController;
use Modules\Auth\Http\Controllers\Auth\VerifyEmailController;
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

Route::middleware('guest:web')->prefix('employee')->group( function () {
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth:sanctum'])->prefix('employee')->group( function () {
    Route::middleware('role:superAdmin')->post('register', [RegisteredUserController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
});
Route::post('/reset-password', [NewPasswordController::class, 'store'])
->name('password.store');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
     ->middleware('guest')
     ->name('password.email');

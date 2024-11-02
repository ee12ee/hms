<?php

use Illuminate\Support\Facades\Route;
use Modules\Department\Http\Controllers\DepartmentController;
use Modules\Department\Http\Controllers\RoomController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('room', [RoomController::class,'index']);
    Route::post('room', [RoomController::class,'store']);
    Route::get('room/{room}', [RoomController::class,'show']);
    Route::get('findRoom', [RoomController::class,'findRoom']);
    Route::patch('room/{room}', [RoomController::class,'update']);
    Route::put('changeRoomStatus/{room}', [RoomController::class,'changeRoomStatus'])->name('changeRoomStatus');
    Route::delete('room/{room}', [RoomController::class,'destroy']);
    Route::patch('bookRoom/{patient}/{room}', [RoomController::class,'bookRoom']);
    Route::patch('unBookRoom/{patientRoom}/{room}', [RoomController::class,'unBookRoom']);
});

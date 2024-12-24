<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('tasks')->group(function(){
        Route::get('/', [TaskController::class,'index']);
        Route::post('store-or-update/{id?}', [TaskController::class,'storeOrUpdate']);
        Route::get('delete/{id}', [TaskController::class,'delete']);
    });
});

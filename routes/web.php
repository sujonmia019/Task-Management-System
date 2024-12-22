<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes([
    'password.confirm' => false, // 404 disabled
    'password.email'   => false, // 404 disabled
    'password.request' => false, // 404 disabled
    'password.reset'   => false, // 404 disabled
    'password.update'  => false, // 404 disabled
]);

Route::name('app.')->middleware('auth')->group(function(){
    // Task Routes
    Route::name('tasks.')->group(function(){
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::post('store-or-update', [TaskController::class, 'storeOrUpdate'])->name('store-or-update');
        Route::post('edit', [TaskController::class, 'edit'])->name('edit');
        Route::post('delete', [TaskController::class, 'delete'])->name('delete');
        Route::get('list/layout', [TaskController::class, 'listLayout'])->name('list.layout');
        Route::post('task/board/store-or-update', [TaskController::class, 'storeOrUpdateTask'])->name('store-or-update.board');
    });

    // Profile Route
    Route::get('profile', [ProfileController::class, 'showForm'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
});



<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Auth::routes([
    'password.confirm' => false, // 404 disabled
    'password.email'   => false, // 404 disabled
    'password.request' => false, // 404 disabled
    'password.reset'   => false, // 404 disabled
    'password.update'  => false, // 404 disabled
]);

Route::name('app.tasks.')->middleware('auth')->group(function(){
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::post('store-or-update', [TaskController::class, 'storeOrUpdate'])->name('store-or-update');
    Route::post('edit', [TaskController::class, 'edit'])->name('edit');
    Route::post('delete', [TaskController::class, 'delete'])->name('delete');
});



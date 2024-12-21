<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Auth::routes([
    'password.confirm' => false, // 404 disabled
    'password.email'   => false, // 404 disabled
    'password.request' => false, // 404 disabled
    'password.reset'   => false, // 404 disabled
    'password.update'  => false, // 404 disabled
]);

Route::get('/', [HomeController::class, 'index'])->name('home');

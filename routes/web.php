<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// prefix: the starting url.
// prefix('admin') => /admin
Route::prefix('admin')->name('admin.')->group(function () {
    // prefix('auth') => /admin/auth
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::get('/login', [AuthController::class, 'view_login'])->name('view_login');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    Route::get('/', [AdminController::class, 'index'])->name('index')->middleware([Authenticate::class]);
});

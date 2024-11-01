<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'view_login'])->name('view_login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/', [DashboardController::class, 'view'])->middleware(['auth', 'role:superadmin'])->name('index');

    Route::prefix('club')->name('club.')->middleware(['auth', 'role:superadmin'])->group(function () {
        Route::get('/', [ClubController::class, 'index'])->name('index');
        Route::get('/create', [ClubController::class, 'view_create'])->name('view_create');
        Route::post('/create', [ClubController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [ClubController::class, 'view_edit'])->name('view_edit');
        Route::post('/edit/{id}', [ClubController::class, 'edit'])->name('edit');
        Route::delete('/deactivate/{id}', [ClubController::class, 'deactivate'])->name('deactivate');
        Route::patch('/activate/{id}', [ClubController::class, 'activate'])->name('activate');
    });

    Route::prefix('user')->name('user.')->middleware(['auth', 'role:superadmin'])->group(function () {
        Route::get('/', function () {
            return view('admin.user.index');
        })->name('index');
    });
});

Route::get('/', function () {
    return view('index');
})->middleware(['auth']);

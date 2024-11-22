<?php

use App\Http\Controllers\ClubAccomplishmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ClubDocumentationController;
use App\Http\Controllers\ClubEventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'view_login'])->name('view_login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/change-password', [AuthController::class, 'view_change_password'])->name('view_change_password');
    Route::patch('/change-password', [AuthController::class, 'change_password'])->name('change_password')->middleware(['auth']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/unauthorized', function () {
        return view('admin.unauthorized');
    })->name('unauthorized');

    Route::get('/', [DashboardController::class, 'view'])->middleware(['auth', 'role:superadmin'])->name('index');

    Route::prefix('club')->name('club.')->middleware(['auth'])->group(function () {
        Route::get('/', [ClubController::class, 'index'])->name('index')->middleware('role:superadmin');
        Route::get('/create', [ClubController::class, 'view_create'])->name('view_create')->middleware('role:superadmin');
        Route::post('/create', [ClubController::class, 'create'])->name('create')->middleware('role:superadmin');
        Route::get('/{clubId}', [ClubController::class, 'details'])->name('details')->middleware('role:superadmin,admin');
        Route::get('/{id}/edit', [ClubController::class, 'view_edit'])->name('view_edit')->middleware('role:superadmin');
        Route::put('/{id}/edit', [ClubController::class, 'edit'])->name('edit')->middleware('role:superadmin');
        Route::delete('/{id}/deactivate', [ClubController::class, 'deactivate'])->name('deactivate')->middleware('role:superadmin');
        Route::patch('/{id}/activate', [ClubController::class, 'activate'])->name('activate')->middleware('role:superadmin');

        Route::prefix('{clubId}/accomplishment')->name('accomplishment.')->middleware('role:superadmin,admin')->group(function () {
            Route::get('/', [ClubAccomplishmentController::class, 'index'])->name('index');
            Route::get('/create', [ClubAccomplishmentController::class, 'view_create'])->name('view_create');
            Route::post('/create', [ClubAccomplishmentController::class, 'create'])->name('create');
            Route::get('/{id}/edit', [ClubAccomplishmentController::class, 'view_edit'])->name('view_edit');
            Route::put('/{id}/edit', [ClubAccomplishmentController::class, 'edit'])->name('edit');
            Route::delete('/{id}/deactivate', [ClubAccomplishmentController::class, 'deactivate'])->name('deactivate');
            Route::patch('/{id}/activate', [ClubAccomplishmentController::class, 'activate'])->name('activate');
        });

        Route::prefix('{clubId}/documentation')->name('documentation.')->middleware('role:superadmin,admin')->group(function () {
            Route::get('/', [ClubDocumentationController::class, 'index'])->name('index');
            Route::get('/create', [ClubDocumentationController::class, 'view_create'])->name('view_create');
            Route::post('/create', [ClubDocumentationController::class, 'create'])->name('create');
            Route::get('/{id}/edit', [ClubDocumentationController::class, 'view_edit'])->name('view_edit');
            Route::put('/{id}/edit', [ClubDocumentationController::class, 'edit'])->name('edit');
            Route::delete('/{id}/deactivate', [ClubDocumentationController::class, 'deactivate'])->name('deactivate');
            Route::patch('/{id}/activate', [ClubDocumentationController::class, 'activate'])->name('activate');
        });

        Route::prefix('{clubId}/event')->name('event.')->middleware('role:superadmin,admin')->group(function () {
            Route::get('/', [ClubEventController::class, 'index'])->name('index');
            Route::get('/create', [ClubEventController::class, 'view_create'])->name('view_create');
            Route::post('/create', [ClubEventController::class, 'create'])->name('create');
            Route::get('/{id}/edit', [ClubEventController::class, 'view_edit'])->name('view_edit');
            Route::put('/{id}/edit', [ClubEventController::class, 'edit'])->name('edit');
            Route::delete('/{id}/deactivate', [ClubEventController::class, 'deactivate'])->name('deactivate');
            Route::patch('/{id}/activate', [ClubEventController::class, 'activate'])->name('activate');
        });
    });

    Route::prefix('user')->name('user.')->middleware(['auth', 'role:superadmin'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'view_create'])->name('view_create');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [UserController::class, 'view_edit'])->name('view_edit');
        Route::put('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::delete('/{id}/deactivate', [UserController::class, 'deactivate'])->name('deactivate');
        Route::patch('/{id}/activate', [UserController::class, 'activate'])->name('activate');
        Route::patch('/{id}/reset-password', [UserController::class, 'reset_password'])->name('reset_password');
    });

    Route::prefix('documentation')->name('documentation.')->middleware(['auth', 'role:superadmin'])->group(function () {
        Route::get('/', [DocumentationController::class, 'index'])->name('index');
        Route::get('/create', [DocumentationController::class, 'view_create'])->name('view_create');
        Route::post('/create', [DocumentationController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [DocumentationController::class, 'view_edit'])->name('view_edit');
        Route::put('/{id}/edit', [DocumentationController::class, 'edit'])->name('edit');
        Route::delete('/{id}/deactivate', [DocumentationController::class, 'deactivate'])->name('deactivate');
        Route::patch('/{id}/activate', [DocumentationController::class, 'activate'])->name('activate');
    });
});

Route::get('/', function () {
    return view('index');
});

<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BarangController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\KategoriController;
use App\Http\Controllers\Web\StokMovementController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', DashboardController::class)->name('dashboard');

    Route::name('web.')->group(function () {
        Route::resource('kategoris', KategoriController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('barangs', BarangController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('stok-movements', StokMovementController::class)->only(['index', 'store', 'destroy']);
    });
});

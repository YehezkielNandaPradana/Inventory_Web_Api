<?php

use App\Http\Controllers\Web\BarangController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\KategoriController;
use App\Http\Controllers\Web\StokMovementController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::name('web.')->group(function () {
    Route::resource('kategoris', KategoriController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('barangs', BarangController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('stok-movements', StokMovementController::class)->only(['index', 'store', 'destroy']);
});

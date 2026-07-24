<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BarangController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\GudangController;
use App\Http\Controllers\Web\KategoriController;
use App\Http\Controllers\Web\KondisiItemController;
use App\Http\Controllers\Web\LaporanController;
use App\Http\Controllers\Web\RekapController;
use App\Http\Controllers\Web\SerahTerimaController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', DashboardController::class)->name('dashboard');

    Route::name('web.')->group(function () {
        Route::resource('gudang', GudangController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('kategoris', KategoriController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('barangs', BarangController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('serah-terima', SerahTerimaController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
        Route::resource('kondisi-item', KondisiItemController::class)->only(['index', 'store', 'destroy']);
        Route::get('rekap', RekapController::class)->name('rekap');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/barang', [LaporanController::class, 'barang'])->name('laporan.barang');
        Route::get('/laporan/serah-terima', [LaporanController::class, 'serahTerima'])->name('laporan.serah-terima');
        Route::get('/laporan/kondisi-item', [LaporanController::class, 'kondisiItem'])->name('laporan.kondisi-item');
    });
});

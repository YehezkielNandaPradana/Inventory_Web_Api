<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\RekapController;
use App\Http\Controllers\Api\StokMovementController;
use App\Http\Controllers\Api\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/profile', [AuthController::class, 'profile']);

Route::apiResource('kategoris', KategoriController::class);
Route::apiResource('barangs', BarangController::class);

Route::get('/barangs/{barang}/history', [BarangController::class, 'history']);

Route::apiResource('transaksi', TransaksiController::class)->only(['index', 'store']);

Route::get('/rekap', [RekapController::class]);

Route::apiResource('stok-movements', StokMovementController::class)->except(['update']);

Route::patch('stok-movements/{stok_movement}', [StokMovementController::class, 'update']);

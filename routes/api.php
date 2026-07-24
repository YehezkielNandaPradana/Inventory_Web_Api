<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\GudangController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\KondisiItemController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\RekapController;
use App\Http\Controllers\Api\SerahTerimaController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/profile', [AuthController::class, 'profile']);

Route::apiResource('gudang', GudangController::class);
Route::apiResource('kategoris', KategoriController::class);
Route::apiResource('barangs', BarangController::class);

Route::get('/barangs/{barang}/history', [BarangController::class, 'history']);

Route::apiResource('serah-terima', SerahTerimaController::class)->only(['index', 'store', 'show', 'destroy']);
Route::apiResource('kondisi-item', KondisiItemController::class)->only(['index', 'store', 'show', 'destroy']);

Route::get('/rekap', RekapController::class);

Route::get('/laporan/barang', [LaporanController::class, 'barang']);
Route::get('/laporan/serah-terima', [LaporanController::class, 'serahTerima']);
Route::get('/laporan/kondisi-item', [LaporanController::class, 'kondisiItem']);

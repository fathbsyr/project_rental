<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\Api\AuthAdminController;
use App\Http\Controllers\Api\AuthPelangganController;
use App\Http\Controllers\BrandController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//autentikasi admin
Route::post('/temp4tr3g18t3ratminr3ntal/register', [AuthAdminController::class, 'register']);
Route::post('/admin/login', [AuthAdminController::class, 'login']);
Route::post('/admin/forgot-password', [AuthAdminController::class, 'forgotPassword']);
Route::post('/admin/reset-password', [AuthAdminController::class, 'resetPassword']);
Route::get('/admin/password/reset/{token}', [AuthAdminController::class, 'showResetForm'])->name('password.reset');

//autentikasi pelanggan
Route::post('/register', [AuthPelangganController::class, 'register']);
Route::post('/login', [AuthPelangganController::class, 'login']);
Route::post('/forgot-password', [AuthPelangganController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthPelangganController::class, 'resetPassword']);
Route::get('/password/reset/{token}', [AuthPelangganController::class, 'showResetForm'])->name('password.reset');

Route::middleware(['auth:admin', 'admin-only'])->group(function () {

    //ulasan
    Route::get('/ulasan', [UlasanController::class, 'index']);
    Route::get('/ulasan/{id}', [UlasanController::class, 'show']);
    Route::post('/ulasan/create', [UlasanController::class, 'store']);
    Route::put('/ulasan/{id}', [UlasanController::class, 'update']);
    Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy']);

    //mobil
    Route::post('/mobil/create', [MobilController::class, 'store']);
    Route::put('/mobil/{id}', [MobilController::class, 'update']);
    Route::delete('/mobil/{id}', [MobilController::class, 'destroy']);
    Route::get('/mobil-edit/{id}', [MobilController::class, 'edit']);

    //denda
    Route::post('/denda/create', [DendaController::class, 'store']);
    Route::put('/denda/{id}', [DendaController::class, 'update']);
    Route::delete('/denda/{id}', [DendaController::class, 'destroy']);
    Route::get('/denda-edit/{id}', [DendaController::class, 'edit']);

    //pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index']);
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show']);
    Route::post('/pembayaran/create', [PembayaranController::class, 'store']);
    Route::put('/pembayaran/{id}', [PembayaranController::class, 'update']);
    Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy']);

    //promosi
    Route::post('/promosi/create', [PromosiController::class, 'store']);
    Route::put('/promosi/{id}', [PromosiController::class, 'update']);
    Route::delete('/promosi/{id}', [PromosiController::class, 'destroy']);
    Route::get('/promosi-edit/{id}', [PromosiController::class, 'edit']);

    //pelanggan
    Route::get('/pelanggan/{id}', [PelangganController::class, 'show']);
    Route::post('/pelanggan/create', [PelangganController::class, 'store']);
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update']);
    Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy']);
    Route::get('/pelanggan-edit/{id}', [PelangganController::class, 'edit']);

    //brand
    Route::get('/brand-edit/{id}', [BrandController::class, 'edit']);
    Route::post('/brand/create', [BrandController::class, 'store']);
    Route::put('/brand/{id}', [BrandController::class, 'update']);
    Route::delete('/brand/{id}', [BrandController::class, 'destroy']);
});

// Middleware untuk pelanggan
Route::middleware(['admin-pelanggan'])->group(function () {
    //ulasan
    Route::post('/ulasan/create', [UlasanController::class, 'store']);
    Route::put('/ulasan/{id}', [UlasanController::class, 'update']);
    Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy']);
    Route::get('/ulasan-edit/{id}', [UlasanController::class, 'edit']);

    //reservasi
    Route::get('/reservasi', [ReservasiController::class, 'index']);
    Route::post('/reservasi/create', [ReservasiController::class, 'store']);
    Route::get('/reservasi/{id}', [ReservasiController::class, 'show']);
    Route::put('/reservasi/{id}', [ReservasiController::class, 'update']);
    Route::delete('/reservasi/{id}', [ReservasiController::class, 'destroy']);
    Route::get('/reservasi-edit/{id}', [ReservasiController::class, 'edit']);

    //pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index']);
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show']);
    Route::post('/pembayaran/create', [PembayaranController::class, 'store']);
    Route::put('/pembayaran/{id}', [PembayaranController::class, 'update']);
    Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy']);
    Route::get('/pembayaran-edit/{id}', [PembayaranController::class, 'edit']);

    Route::get('/denda', [DendaController::class, 'index']);
    Route::get('/denda/{id}', [DendaController::class, 'show']);

    Route::get('/reservasi', [ReservasiController::class, 'index']);
    Route::get('/reservasi/{id}', [ReservasiController::class, 'show']);

    Route::get('/pembayaran', [PembayaranController::class, 'index']);
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show']);

    Route::get('/pelanggan', [PelangganController::class, 'index']);
});

Route::get('/brand', [BrandController::class, 'index']);
Route::get('/brand/{id}', [BrandController::class, 'show']);

Route::get('/mobil', [MobilController::class, 'index']);
Route::get('/mobil/{id}', [MobilController::class, 'show']);

Route::get('/ulasan', [UlasanController::class, 'index']);
Route::get('/ulasan/{id}', [UlasanController::class, 'show']);

Route::get('/promosi', [PromosiController::class, 'index']);
Route::get('/promosi/{id}', [PromosiController::class, 'show']);

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//mobil
Route::get('/mobil', [MobilController::class, 'index']);
Route::get('/mobil/{id}', [MobilController::class, 'show']);
Route::post('/mobil/create', [MobilController::class, 'store']);
Route::put('/mobil/{id}', [MobilController::class, 'update']);
Route::delete('/mobil/{id}', [MobilController::class, 'destroy']);

//ulasan
Route::get('/ulasan', [UlasanController::class, 'index']);
Route::get('/ulasan/{id}', [UlasanController::class, 'show']);
Route::post('/ulasan/create', [UlasanController::class, 'store']);
Route::put('/ulasan/{id}', [UlasanController::class, 'update']);
Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy']);

//denda
Route::get('/denda', [DendaController::class, 'index']);
Route::get('/denda/{id}', [DendaController::class, 'show']);
Route::post('/denda/create', [DendaController::class, 'store']);
Route::put('/denda/{id}', [DendaController::class, 'update']);
Route::delete('/denda/{id}', [DendaController::class, 'destroy']);

//reservasi
Route::get('/reservasi', [ReservasiController::class, 'index']);
Route::post('/reservasi/create', [ReservasiController::class, 'store']);
Route::get('/reservasi/{id}', [ReservasiController::class, 'show']);
Route::put('/reservasi/{id}', [ReservasiController::class, 'update']);
Route::delete('/reservasi/{id}', [ReservasiController::class, 'destroy']);

//Pembayaran
Route::get('/pembayaran', [PembayaranController::class, 'index']);
Route::get('/pembayaran/{id}', [PembayaranController::class, 'show']);
Route::post('/pembayaran/create', [PembayaranController::class, 'store']);
Route::put('/pembayaran/{id}', [PembayaranController::class, 'update']);
Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy']);

//promosi
Route::get('/promosi', [PromosiController::class, 'index']);
Route::get('/promosi/{id}', [PromosiController::class, 'show']);
Route::post('/promosi/create', [PromosiController::class, 'store']);
Route::put('/promosi/{id}', [PromosiController::class, 'update']);
Route::delete('/promosi/{id}', [PromosiController::class, 'destroy']);

//pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index']);
Route::get('/pelanggan/{id}', [PelangganController::class, 'show']);
Route::post('/pelanggan/create', [PelangganController::class, 'store']);
Route::put('/pelanggan/{id}', [PelangganController::class, 'update']);
Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy']);

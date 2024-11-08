<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\UlasanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//mobil
Route::get('/mobil', [MobilController::class, 'index']);

//ulasan
Route::get('/ulasan', [UlasanController::class, 'index']);


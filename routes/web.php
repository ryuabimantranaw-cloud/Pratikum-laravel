<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Route;

// Halaman login (bebas diakses)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

// MIDDLEWARE "auth" = satpam pintu masuk: wajib login
Route::middleware('auth')->group(function () {

    Route::get('/', fn () => redirect()->route('dokter.index'));
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Semua user login boleh LIHAT data
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');

    // AUTHORIZATION "role:admin" = ruang VIP: khusus admin
    Route::middleware('role:admin')->group(function () {
        Route::delete('/dokter/reset', [DokterController::class, 'reset'])->name('dokter.reset');
        Route::resource('dokter', DokterController::class)->except(['index', 'show']);
    });
});
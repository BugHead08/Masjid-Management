<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalImamController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PengajianController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route ini dipakai untuk halaman web (Blade).
| Endpoint API JSON untuk Postman sebaiknya ditaruh di routes/api.php
|
*/

// ======================
// Guest Routes (belum login)
// ======================
Route::middleware('guest')->group(function () {
    // Halaman login (Blade)
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'webLogin'])->name('login.auth');

    // Halaman publik
    Route::get('/', [DashboardController::class, 'home'])->name('home');
    Route::get('/imam-khotib', [JadwalImamController::class, 'index'])->name('imamkhotib');
    Route::get('/kegiatan', [PengajianController::class, 'index'])->name('kegiatan');
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('guest.keuangan.index');
});

// ======================
// Authenticated Routes (sudah login)
// ======================
Route::middleware('auth')->group(function () {
    // Dashboard admin
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');

    // ======================
    // CRUD Keuangan
    // ======================
    Route::prefix('admin/keuangan')->name('keuangan.')->group(function () {
        Route::get('/', [KeuanganController::class, 'index'])->name('index');
        Route::post('/', [KeuanganController::class, 'store'])->name('store');
        Route::put('/{id}', [KeuanganController::class, 'update'])->name('update');
        Route::delete('/{id}', [KeuanganController::class, 'destroy'])->name('destroy');
    });

    // ======================
    // CRUD Pengajian
    // ======================
    Route::prefix('admin/pengajian')->name('pengajian.')->group(function () {
        Route::get('/', [PengajianController::class, 'index'])->name('index');
        Route::post('/', [PengajianController::class, 'store'])->name('store');
        Route::put('/{id}', [PengajianController::class, 'update'])->name('update');
        Route::delete('/{id}', [PengajianController::class, 'destroy'])->name('destroy');
    });

    // ======================
    // CRUD Jadwal Imam
    // ======================
    Route::prefix('admin/imam')->name('imam.')->group(function () {
        Route::get('/', [JadwalImamController::class, 'index'])->name('index');
        Route::post('/', [JadwalImamController::class, 'store'])->name('store');
        Route::put('/{id}', [JadwalImamController::class, 'update'])->name('update');
        Route::delete('/{id}', [JadwalImamController::class, 'destroy'])->name('destroy');
    });

    // ======================
    // Logout Web
    // ======================
    Route::post('/logout', [AuthController::class, 'webLogout'])->name('logout');
});

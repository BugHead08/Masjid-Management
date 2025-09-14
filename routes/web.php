<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalImamController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PengajianController;
use App\Models\JadwalImam;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.auth');
    Route::get('/',[DashboardController::class,'home'])->name('home');
    Route::get('/imam-khotib',[JadwalImamController::class,'index'])->name('imamkhotib');
    Route::get('/kegiatan', [PengajianController::class,'index'])->name('kegiatan');
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('guest.keuangan.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');

    // keuangan
    Route::get('/admin/keuangan', [KeuanganController::class, 'index'])->name('keuangan');
    Route::post('/admin/keuangan', [KeuanganController::class, 'store'])->name('keuangan.input');
    Route::put('/admin/keuangan/{id}', [KeuanganController::class, 'update'])->name('keuangan.update');
    Route::delete('/admin/keuangan/{id}', [KeuanganController::class, 'destroy'])->name('keuangan.delete');

    // pengajian
    Route::get('/admin/pengajian', [PengajianController::class, 'index'])->name('pengajian');
    Route::post('/admin/pengajian', [PengajianController::class, 'store'])->name('pengajian.input');
    Route::put('/admin/pengajian/{id}', [PengajianController::class, 'update'])->name('pengajian.update');
    Route::delete('/admin/pengajian/{id}', [PengajianController::class, 'destroy'])->name('pengajian.delete');

    // jadwal imam
    Route::get('/admin/imam', [JadwalImamController::class, 'index'])->name('imam');
    Route::post('/admin/imam', [JadwalImamController::class, 'store'])->name('imam.input');
    Route::put('/admin/imam/{id}', [JadwalImamController::class, 'update'])->name('imam.update');
    Route::delete('/admin/imam/{id}', [JadwalImamController::class, 'destroy'])->name('imam.delete');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

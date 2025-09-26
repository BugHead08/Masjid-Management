<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Semua route di sini otomatis punya prefix "/api".
| Contoh akses: http://localhost:8000/api/login
|
*/

// ======================
// Public Routes (tanpa token)
// ======================
Route::post('/register', [AuthController::class, 'register']);   // buat user baru
Route::post('/login', [AuthController::class, 'apiLogin']);      // login API (JSON + token)

// ======================
// Protected Routes (butuh token Sanctum)
// ======================
Route::middleware('auth:sanctum')->group(function () {
    // Get data user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout API (hapus token)
    Route::post('/logout', [AuthController::class, 'apiLogout']);

    // Hapus user by ID
    Route::delete('/users/{id}', [AuthController::class, 'destroy']);
});

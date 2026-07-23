<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rute untuk pengguna yang BELUM login (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Rute untuk pengguna yang SUDAH login (auth)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Uji coba Middleware Multi-Role: Semua role boleh masuk dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return "Berhasil Login! Selamat datang, " . $user->name . ". Role Anda adalah: " . strtoupper($user->role);
    })->middleware('role:admin,gudang,kasir');
});
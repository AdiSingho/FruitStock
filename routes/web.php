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
        
        // routes/web.php

    // Rute Dashboard yang mengarah ke tampilan dashboard.blade.php
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('role:admin,gudang,kasir')->name('dashboard'); // Tambahkan .name('dashboard') di sini
});

// Rute Master Data (Bisa diakses Admin dan Petugas Gudang)
    Route::middleware('role:admin,gudang')->group(function () {
        Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
        Route::resource('gudang', \App\Http\Controllers\GudangController::class);
        Route::resource('supplier', \App\Http\Controllers\SupplierController::class);
        Route::resource('buah', \App\Http\Controllers\BuahController::class);
        Route::resource('stok', \App\Http\Controllers\StokController::class);
        Route::resource('qc-retur', \App\Http\Controllers\QcReturController::class);
    });

// Rute Operasional Kasir (Bisa diakses Admin dan Kasir)
    Route::middleware('role:admin,kasir')->group(function () {
        Route::get('transaksi', [\App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('transaksi/create', [\App\Http\Controllers\TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('transaksi', [\App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');
    });
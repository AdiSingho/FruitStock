<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{AuthController, DashboardController, KategoriController, GudangController, SupplierController, BuahController, StokController, TransaksiController, QcReturController, PosController};

// Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Auth (Sudah Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin & Gudang
    Route::middleware('role:admin,gudang')->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('gudang', GudangController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('buah', BuahController::class);
        Route::resource('stok', StokController::class);
        Route::resource('qc-retur', QcReturController::class);
    });

    // Admin & Kasir
    Route::middleware('role:admin,kasir')->group(function () {
        Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

        // 2. Rute POS ditambahkan di sini, berdampingan dengan transaksi
        Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
        Route::post('/pos/checkout', [PosController::class, 'store'])->name('pos.store');
    });
});
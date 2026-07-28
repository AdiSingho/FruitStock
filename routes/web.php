<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{AuthController, DashboardController, KategoriController, GudangController, SupplierController, BuahController, StokController, TransaksiController, QcReturController, PosController, ProfileController, LaporanController};

// Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Auth (Sudah Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Admin & Gudang
    Route::middleware('role:admin,gudang')->group(function () {

        Route::get('/buah/search', [BuahController::class, 'search'])->name('buah.search');

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

        Route::get('/transaksi/{id}/print', [TransaksiController::class, 'print'])->name('transaksi.print');
        Route::get('/pos/{id}/print', [PosController::class, 'print'])->name('pos.print');

        // 3. Rute POS ditambahkan di sini, berdampingan dengan transaksi
        Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
        Route::post('/pos/checkout', [PosController::class, 'store'])->name('pos.store');
    });

    // Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    });
});
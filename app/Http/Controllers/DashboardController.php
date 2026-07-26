<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Penjualan; // Wajib ditambahkan agar bisa membaca tabel penjualan
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Stok (Sum dari kolom jumlah)
        $totalStok = Stok::sum('jumlah');

        // 2. Item Hampir Habis (stok di bawah 10)
        $itemHampirHabis = Stok::where('jumlah', '<', 10)->count();

        // 3. Mendekati Busuk (Estimasi kadaluarsa dalam 3 hari ke depan)
        $mendekatBusuk = Stok::where('estimasi_kadaluarsa', '<=', Carbon::now()->addDays(3))->count();

        // 4. Data untuk tabel (5 data yang paling dekat kadaluarsa)
        $stokKritis = Stok::with('buah')
            ->orderBy('estimasi_kadaluarsa', 'asc')
            ->limit(5)
            ->get();

        // 5. MENGHITUNG PENJUALAN HARI INI
        // Mencari semua transaksi di hari ini, lalu menjumlahkan kolom 'total_harga'
        $penjualanHariIni = Penjualan::whereDate('created_at', Carbon::today())->sum('total_harga');

        return view('dashboard.index', compact(
            'totalStok', 
            'itemHampirHabis', 
            'mendekatBusuk', 
            'penjualanHariIni', 
            'stokKritis'
        ));
    }
}
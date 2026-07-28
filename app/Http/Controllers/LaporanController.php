<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan; // Ubah dari Transaksi ke Penjualan

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default tanggal: awal bulan sampai hari ini
        $startDate = $request->start_date ?? date('Y-m-01');
        $endDate = $request->end_date ?? date('Y-m-d');

        // Mengambil data dari Model Penjualan
        $transaksi = Penjualan::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                     ->orderBy('created_at', 'desc')
                     ->get();

        $totalPendapatan = $transaksi->sum('total_harga');

        return view('laporan.index', compact('transaksi', 'totalPendapatan', 'startDate', 'endDate'));
    }

   public function cetak(Request $request)
    {
        // Ambil filter tanggal dari URL
        $tgl_mulai = $request->start_date ?? date('Y-m-d');
        $tgl_akhir = $request->end_date ?? date('Y-m-d');

        // Ambil data tanpa memanggil relasi buah yang tidak ada
        $transaksi = \App\Models\Penjualan::whereBetween('created_at', [$tgl_mulai . ' 00:00:00', $tgl_akhir . ' 23:59:59'])->get();
        
        $totalPendapatan = $transaksi->sum('total_harga');

        return view('laporan.cetak', compact('transaksi', 'tgl_mulai', 'tgl_akhir', 'totalPendapatan'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiDetail; // Pastikan menggunakan model ini untuk Eager Loading

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default tanggal: awal bulan sampai hari ini
        $tgl_mulai = $request->start_date ?? date('Y-m-01');
        $tgl_akhir = $request->end_date ?? date('Y-m-d');

        // Mengambil data menggunakan Eager Loading sesuai panduan UAS[cite: 1]
        // Ini sinkron dengan tabel ERD[cite: 2]
        $transaksiDetail = TransaksiDetail::with(['transaksi', 'stok.buah'])
            ->whereHas('transaksi', function($query) use ($tgl_mulai, $tgl_akhir) {
                $query->whereBetween('tanggal_transaksi', [$tgl_mulai . ' 00:00:00', $tgl_akhir . ' 23:59:59']);
            })->get();

        $totalPendapatan = $transaksiDetail->sum('subtotal');

        return view('laporan.index', [
            'transaksiDetail' => $transaksiDetail,
            'totalPendapatan' => $totalPendapatan,
            'tgl_mulai' => $tgl_mulai,
            'tgl_akhir' => $tgl_akhir
        ]);
    }

    public function cetak(Request $request)
    {
        $tgl_mulai = $request->start_date ?? date('Y-m-d');
        $tgl_akhir = $request->end_date ?? date('Y-m-d');

        // Menggunakan Eager Loading agar performa optimal[cite: 1]
        $transaksiDetail = TransaksiDetail::with(['transaksi', 'stok.buah'])
            ->whereHas('transaksi', function($query) use ($tgl_mulai, $tgl_akhir) {
                $query->whereBetween('tanggal_transaksi', [$tgl_mulai . ' 00:00:00', $tgl_akhir . ' 23:59:59']);
            })->get();

        $totalPendapatan = $transaksiDetail->sum('subtotal');

        return view('laporan.cetak', compact('transaksiDetail', 'tgl_mulai', 'tgl_akhir', 'totalPendapatan'));
    }
}
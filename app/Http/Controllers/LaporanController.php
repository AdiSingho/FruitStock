<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiDetail; 

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tgl_mulai = $request->start_date ?? date('Y-m-01');
        $tgl_akhir = $request->end_date ?? date('Y-m-d');

        $transaksiDetail = TransaksiDetail::with(['transaksi', 'stok.buah'])
            ->whereHas('transaksi', function($query) use ($tgl_mulai, $tgl_akhir) {
                $query->whereBetween('tanggal_transaksi', [$tgl_mulai . ' 00:00:00', $tgl_akhir . ' 23:59:59']);
            })->get();

        $totalPendapatan = $transaksiDetail->sum('subtotal');

        // TAMBAHAN: Kelompokkan data berdasarkan transaksi_id
        $groupedTransaksi = $transaksiDetail->groupBy('transaksi_id');

        return view('laporan.index', [
            'groupedTransaksi' => $groupedTransaksi, // Kirim data yang sudah dikelompokkan
            'totalPendapatan' => $totalPendapatan,
            'tgl_mulai' => $tgl_mulai,
            'tgl_akhir' => $tgl_akhir
        ]);
    }

    public function cetak(Request $request)
    {
        $tgl_mulai = $request->start_date ?? date('Y-m-01');
        $tgl_akhir = $request->end_date ?? date('Y-m-d');

        $transaksiDetail = TransaksiDetail::with(['transaksi', 'stok.buah'])
            ->whereHas('transaksi', function($query) use ($tgl_mulai, $tgl_akhir) {
                $query->whereBetween('tanggal_transaksi', [$tgl_mulai . ' 00:00:00', $tgl_akhir . ' 23:59:59']);
            })->get();

        $totalPendapatan = $transaksiDetail->sum('subtotal');
        
        // TAMBAHAN: Kelompokkan juga untuk halaman cetak
        $groupedTransaksi = $transaksiDetail->groupBy('transaksi_id');

        return view('laporan.cetak', compact('groupedTransaksi', 'tgl_mulai', 'tgl_akhir', 'totalPendapatan'));
    }
}
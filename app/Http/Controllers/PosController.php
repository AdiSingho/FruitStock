<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class PosController extends Controller
{
    public function index()
    {
        $stoks = Stok::with('buah')->where('jumlah', '>', 0)->get(); 
        return view('pos.index', compact('stoks'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'stok_id' => 'required|array',
            'qty' => 'required|array',
            'harga_satuan' => 'required|array',
            'total_harga' => 'required|numeric',
            'bayar' => 'required|numeric|gte:total_harga', 
        ]);

        // 2. Hitung kembalian secara manual di sini (Hanya untuk tampil di notifikasi)
        $jumlahBayar = (float)$request->bayar;
        $totalBelanja = (float)$request->total_harga;
        $kembalian = $jumlahBayar - $totalBelanja;

        DB::beginTransaction();

        try {
            // 3. Simpan hanya kolom yang ada di database
            $transaksi = Transaksi::create([
                'tanggal_transaksi' => Carbon::now(), 
                'total_harga' => $totalBelanja,
                'user_id' => auth()->id(),
            ]);

            // 4. Looping detail transaksi
            foreach ($request->stok_id as $index => $stokId) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id, 
                    'stok_id' => $stokId,
                    'qty' => $request->qty[$index], 
                    'harga_satuan' => $request->harga_satuan[$index],
                    'subtotal' => $request->qty[$index] * $request->harga_satuan[$index],
                ]);

                $stok = Stok::find($stokId);
                $stok->decrement('jumlah', $request->qty[$index]);
            }

            DB::commit();

            // 5. Kirim pesan sukses menggunakan variabel $kembalian yang sudah dihitung manual
            return back()->with([
                'success' => 'Transaksi berhasil! Kembalian: Rp ' . number_format($kembalian, 0, ',', '.'),
                'print_id' => $transaksi->id 
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function print($id)
    {
        $penjualan = Transaksi::findOrFail($id);
        $details = TransaksiDetail::where('transaksi_id', $id)->get();
        
        foreach($details as $detail) {
            $stok = Stok::with('buah')->find($detail->stok_id);
            $detail->nama_buah = $stok && $stok->buah ? $stok->buah->nama_buah : 'Buah';
        }
        
        return view('pos.print', compact('penjualan', 'details'));
    }
}
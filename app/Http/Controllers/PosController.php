<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class PosController extends Controller
{
    public function index()
    {
        // Mengambil data stok yang jumlahnya lebih dari 0 beserta relasi buah
        $stoks = Stok::with('buah')->where('jumlah', '>', 0)->get(); 
        
        return view('pos.index', compact('stoks'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form HTML
        $request->validate([
            'stok_id' => 'required|array',
            'qty' => 'required|array',
            'harga_satuan' => 'required|array',
            'total_harga' => 'required|numeric',
            'bayar' => 'required|numeric|gte:total_harga', // Bayar harus lebih besar atau sama dengan total
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // 1. Simpan ke tabel penjualans
            $penjualan = Penjualan::create([
                'no_transaksi' => 'TRX-' . date('YmdHis'),
                'total_harga' => $request->total_harga,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $request->total_harga,
            ]);

            // 2. Looping array stok_id untuk menyimpan detail transaksi dan mengurangi stok
            foreach ($request->stok_id as $index => $stokId) {
                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'stok_id' => $stokId,
                    'jumlah' => $request->qty[$index],
                    'harga_satuan' => $request->harga_satuan[$index],
                    'subtotal' => $request->qty[$index] * $request->harga_satuan[$index],
                ]);

                // Kurangi stok di gudang
                $stok = Stok::find($stokId);
                $stok->decrement('jumlah', $request->qty[$index]);
            }

            // Simpan semua proses di atas secara permanen
            DB::commit();

            // Return dengan variabel $penjualan yang sudah benar
            return back()->with([
                'success' => 'Transaksi berhasil! Kembalian: Rp ' . number_format($penjualan->kembalian, 0, ',', '.'),
                'print_id' => $penjualan->id // Menggunakan $penjualan->id agar bisa dibaca tombol cetak
            ]);

        } catch (\Exception $e) {
            // Jika ada error, batalkan semua proses (rollback)
            DB::rollback();
            
            return back()->with('error', 'Terjadi kesalahan saat memproses transaksi: ' . $e->getMessage());
        }
    }

    // FUNGSI BARU UNTUK CETAK STRUK POS
    public function print($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        
        // Ambil detail penjualan
        $details = DetailPenjualan::where('penjualan_id', $id)->get();
        
        // Kita ambil manual nama buahnya agar aman (tidak error relasi)
        foreach($details as $detail) {
            $stok = Stok::with('buah')->find($detail->stok_id);
            $detail->nama_buah = $stok && $stok->buah ? $stok->buah->nama_buah : 'Buah';
        }
        
        return view('pos.print', compact('penjualan', 'details'));
    }
}
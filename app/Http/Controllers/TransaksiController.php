<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // 1. Fungsi ini sekarang khusus untuk menampilkan Riwayat Transaksi
    public function index()
    {
        // Mengambil semua riwayat transaksi dari yang terbaru
        $transaksis = Transaksi::latest()->get();
        
        // Tampilkan ke view tabel riwayat yang baru saja Anda buat
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        // Dikosongkan karena tampilan POS sudah diurus oleh PosController
    }

    // 2. Fungsi simpan transaksi (Tetap sama seperti milik Anda)
    public function store(Request $request) 
    {
        if (!$request->has('stok_id')) {
            return back()->with('error', 'Keranjang belanja masih kosong!');
        }

        DB::beginTransaction();
        
        try {
            $transaksi = Transaksi::create([
                'user_id' => auth()->id(), 
                'total_harga' => $request->total_harga,
                'tanggal_transaksi' => now(),
            ]);

            $stok_ids = $request->stok_id;
            $qtys = $request->qty;
            $harga_satuans = $request->harga_satuan;
            $subtotals = $request->subtotal;

            for ($i = 0; $i < count($stok_ids); $i++) {
                
                $stok = Stok::findOrFail($stok_ids[$i]);

                if ($stok->jumlah < $qtys[$i]) {
                    throw new \Exception("Stok tidak mencukupi untuk batch: " . $stok->kode_batch);
                }

                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'stok_id' => $stok_ids[$i],
                    'qty' => $qtys[$i],
                    'harga_satuan' => $harga_satuans[$i],
                    'subtotal' => $subtotals[$i],
                ]);

                $stok->jumlah = $stok->jumlah - $qtys[$i];
                $stok->save();
            }

            DB::commit(); 

            return redirect('/transaksi')->with([
                'success' => 'Transaksi Berhasil! Stok telah dipotong.',
                'print_id' => $transaksi->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->with('error', $e->getMessage());
        }
    }

    // 3. Fungsi untuk Cetak Struk
    public function print($id)
    {
        // PERHATIKAN: Karena Anda menyimpan 'stok_id' di transaksi detail, 
        // kita panggil relasi beruntun: details -> stok -> buah
        $transaksi = Transaksi::with(['details.stok.buah'])->findOrFail($id);
        
        return view('transaksi.print', compact('transaksi'));
    }
}
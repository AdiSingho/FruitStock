<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Stok;
use App\Models\Buah;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        // 1. Ambil data stok yang jumlahnya masih ada (lebih dari 0)
        // Kita panggil relasi 'buah' agar nama buahnya bisa tampil
        $stoks = \App\Models\Stok::with('buah')->where('jumlah', '>', 0)->get();
        
        // 2. Tampilkan halaman POS Kasir yang tadi kita buat
        // Pastikan nama folder dan filenya sesuai (pos/index.blade.php)
        return view('pos.index', compact('stoks'));
    }

    public function create()
    {
        // return view('transaksi.pos'); // Halaman mesin kasir
    }

    public function store(Request $request) 
    {
        // 1. Validasi keranjang tidak boleh kosong
        if (!$request->has('stok_id')) {
            return back()->with('error', 'Keranjang belanja masih kosong!');
        }

        // Mulai transaksi database agar aman jika terjadi error di tengah jalan
        DB::beginTransaction();
        
        try {
            // 2. Buat Header Transaksi
            $transaksi = Transaksi::create([
                'user_id' => auth()->id(), // Pastikan user sudah login
                'total_harga' => $request->total_harga,
                'tanggal_transaksi' => now(),
            ]);

            // 3. Ambil data array dari form kasir (Blade)
            $stok_ids = $request->stok_id;
            $qtys = $request->qty;
            $harga_satuans = $request->harga_satuan;
            $subtotals = $request->subtotal;

            // 4. Looping setiap barang yang dibeli
            for ($i = 0; $i < count($stok_ids); $i++) {
                
                // Cari stok fisik berdasarkan ID yang diklik kasir
                $stok = Stok::findOrFail($stok_ids[$i]);

                // Cek apakah stok cukup
                if ($stok->jumlah < $qtys[$i]) {
                    throw new \Exception("Stok tidak mencukupi untuk batch: " . $stok->kode_batch);
                }

                // Simpan ke Transaksi Detail
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'stok_id' => $stok_ids[$i],
                    'qty' => $qtys[$i],
                    'harga_satuan' => $harga_satuans[$i],
                    'subtotal' => $subtotals[$i],
                ]);

                // 5. POTONG STOK OTOMATIS
                $stok->jumlah = $stok->jumlah - $qtys[$i];
                $stok->save();
            }

            DB::commit(); // Simpan permanen ke database

            // Kembali ke halaman kasir dengan pesan sukses
            return redirect('/transaksi')->with('success', 'Transaksi Berhasil! Stok telah dipotong.');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua proses jika ada yang gagal (misal stok kurang)
            
            // Kembali ke halaman kasir bawa pesan error
            return back()->with('error', $e->getMessage());
        }
    }
}
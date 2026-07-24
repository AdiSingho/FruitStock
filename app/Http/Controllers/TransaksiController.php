<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Stok;
use App\Models\Buah;
use App\Http\Requests\StoreTransaksiRequest;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        // Menampilkan riwayat transaksi (bisa dilihat Kasir & Admin)
        $transaksis = Transaksi::with(['user'])->orderBy('created_at', 'desc')->get();
        return response()->json($transaksis);
    }

    public function create()
    {
        // return view('transaksi.pos'); // Halaman mesin kasir
    }

    public function store(StoreTransaksiRequest $request)
    {
        $keranjang = $request->validated()['keranjang'];
        
        // Memulai transaksi database agar jika error, data tidak tersimpan setengah-setengah
        DB::beginTransaction();
        
        try {
            $totalHarga = 0;
            
            // 1. Buat Header Transaksi terlebih dahulu
            $transaksi = Transaksi::create([
                'user_id' => auth()->id(),
                'total_harga' => 0, // Set 0 dulu, nanti di-update
                'tanggal_transaksi' => now(),
            ]);

            // 2. Looping setiap barang di keranjang
            foreach ($keranjang as $item) {
                $buah = Buah::findOrFail($item['buah_id']);
                $qtyDibutuhkan = $item['qty'];
                
                $hargaSatuan = $buah->harga_jual;
                $subtotalItem = $qtyDibutuhkan * $hargaSatuan;
                $totalHarga += $subtotalItem;

                // 3. Catat ke Transaksi Detail
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'stok_id' => null, // Dikosongkan sementara atau direlasi ke stok spesifik jika perlu audit batch
                    'qty' => $qtyDibutuhkan,
                    'harga_satuan' => $hargaSatuan,
                    'subtotal' => $subtotalItem,
                ]);

                // 4. ALGORITMA FEFO (Cari stok dari kadaluarsa paling dekat)
                $stokTersedia = Stok::where('buah_id', $buah->id)
                                    ->where('jumlah', '>', 0)
                                    ->orderBy('estimasi_kadaluarsa', 'asc')
                                    ->get();

                // Cek apakah stok total mencukupi
                if ($stokTersedia->sum('jumlah') < $qtyDibutuhkan) {
                    throw new \Exception("Stok {$buah->nama_buah} tidak mencukupi!");
                }

                // 5. Kurangi stok satu per satu berdasarkan batch terdekat
                foreach ($stokTersedia as $stokBatch) {
                    if ($qtyDibutuhkan <= 0) break;

                    if ($stokBatch->jumlah >= $qtyDibutuhkan) {
                        // Jika batch ini cukup untuk memenuhi sisa kebutuhan
                        $stokBatch->jumlah -= $qtyDibutuhkan;
                        $stokBatch->save();
                        $qtyDibutuhkan = 0;
                    } else {
                        // Jika batch ini tidak cukup, kurangi semua, lalu lanjut ke batch berikutnya
                        $qtyDibutuhkan -= $stokBatch->jumlah;
                        $stokBatch->jumlah = 0;
                        $stokBatch->save();
                    }
                }
            }

            // 6. Update total harga transaksi
            $transaksi->update(['total_harga' => $totalHarga]);

            DB::commit(); // Simpan semua perubahan permanen
            return response()->json(['message' => 'Transaksi berhasil diproses!', 'data' => $transaksi]);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua proses jika terjadi error
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
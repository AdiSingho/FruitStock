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
    // Menampilkan riwayat transaksi
    public function index()
    {
        $transaksis = Transaksi::with(['user'])->orderBy('created_at', 'desc')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    // Menampilkan halaman Kasir/POS
    public function create()
    {
        $buahs = Buah::all();
        return view('transaksi.create', compact('buahs'));
    }

    // Memproses transaksi
    public function store(StoreTransaksiRequest $request)
    {
        $keranjang = $request->validated()['keranjang'];
        
        DB::beginTransaction();
        
        try {
            $totalHarga = 0;
            
            // 1. Buat Header Transaksi
            $transaksi = Transaksi::create([
                'user_id' => auth()->id(),
                'total_harga' => 0, 
                'tanggal_transaksi' => now(),
            ]);

            // 2. Looping keranjang
            foreach ($keranjang as $item) {
                $buah = Buah::findOrFail($item['buah_id']);
                $qtyDibutuhkan = $item['qty'];
                
                $hargaSatuan = $buah->harga_jual;
                $subtotalItem = $qtyDibutuhkan * $hargaSatuan;
                $totalHarga += $subtotalItem;

                // 3. Catat Transaksi Detail
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'stok_id' => null, 
                    'qty' => $qtyDibutuhkan,
                    'harga_satuan' => $hargaSatuan,
                    'subtotal' => $subtotalItem,
                ]);

                // 4. ALGORITMA FEFO
                $stokTersedia = Stok::where('buah_id', $buah->id)
                                    ->where('jumlah', '>', 0)
                                    ->orderBy('estimasi_kadaluarsa', 'asc')
                                    ->get();

                if ($stokTersedia->sum('jumlah') < $qtyDibutuhkan) {
                    throw new \Exception("Stok {$buah->nama_buah} tidak mencukupi!");
                }

                // 5. Kurangi stok
                foreach ($stokTersedia as $stokBatch) {
                    if ($qtyDibutuhkan <= 0) break;

                    if ($stokBatch->jumlah >= $qtyDibutuhkan) {
                        $stokBatch->jumlah -= $qtyDibutuhkan;
                        $stokBatch->save();
                        $qtyDibutuhkan = 0;
                    } else {
                        $qtyDibutuhkan -= $stokBatch->jumlah;
                        $stokBatch->jumlah = 0;
                        $stokBatch->save();
                    }
                }
            }

            // 6. Update total
            $transaksi->update(['total_harga' => $totalHarga]);

            DB::commit(); 
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diproses!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    // Menampilkan detail invoice
    public function show($id)
    {
        $transaksi = Transaksi::with(['transaksiDetails', 'user'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    // Transaksi bersifat final, tidak bisa diedit
    public function edit(Transaksi $transaksi)
    {
        abort(403, 'Transaksi tidak dapat diubah.');
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        abort(403, 'Transaksi tidak dapat diubah.');
    }

    public function destroy(Transaksi $transaksi)
    {
        abort(403, 'Transaksi tidak dapat dihapus.');
    }
}
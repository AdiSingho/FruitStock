<?php

namespace App\Http\Controllers;

use App\Models\QcRetur;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QcReturController extends Controller
{
    public function index()
    {
        // Ambil riwayat QC untuk tabel sebelah kanan
        $qcReturs = QcRetur::with(['stok.buah', 'user'])->latest()->get();
        
        // Ambil data stok buah untuk form sebelah kiri
        $stoks = Stok::with('buah')->where('jumlah', '>', 0)->get();
        
        // Kirim keduanya ke halaman index
        return view('qc-retur.index', compact('qcReturs', 'stoks'));
    }

    public function create()
    {
        // Ambil stok yang masih ada barangnya untuk ditampilkan di pilihan dropdown
        $stoks = Stok::with('buah')->where('jumlah', '>', 0)->get();
        return view('qc-retur.create', compact('stoks'));
    }

    public function store(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'stok_id' => 'required',
            'qty_rusak' => 'required|numeric|min:0.1',
            'alasan' => 'required',
            'tindakan' => 'required|in:buang,retur',
            'tanggal_qc' => 'required|date',
            'status' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // 2. Cari data stok yang dipilih
            $stok = Stok::findOrFail($request->stok_id);

            // Cek apakah jumlah rusak tidak melebihi sisa stok di gudang
            if ($stok->jumlah < $request->qty_rusak) {
                return back()->with('error', 'Jumlah barang rusak melebihi sisa stok yang ada di gudang!');
            }

            // 3. Simpan data QC
            QcRetur::create([
                'stok_id' => $request->stok_id,
                'user_id' => auth()->id(), // Otomatis catat ID petugas yang login
                'qty_rusak' => $request->qty_rusak,
                'alasan' => $request->alasan,
                'tindakan' => $request->tindakan,
                'tanggal_qc' => $request->tanggal_qc,
                'status' => $request->status,
            ]);

            // 4. POTONG STOK OTOMATIS
            $stok->jumlah -= $request->qty_rusak;
            $stok->save();

            DB::commit();

            return redirect()->route('qc-retur.index')->with('success', 'Data QC berhasil dicatat dan stok telah dikurangi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Buah;
use App\Models\Gudang;    // <--- INI PENTING
use App\Models\Supplier;  // <--- INI PENTING
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateStokRequest;
use Carbon\Carbon; 

class StokController extends Controller
{
    public function index(Request $request)
    {
        dd($request->search);
        // 1. Mulai query dan panggil relasi
        $query = \App\Models\Stok::with(['buah', 'gudang', 'supplier']);

        // 2. Jika ada request 'search' dari URL
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            // 3. Bungkus query pencarian di dalam function() agar lebih spesifik dan aman
            $query->where(function($q) use ($search) {
                $q->where('kode_batch', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('buah', function($q2) use ($search) {
                      $q2->where('nama_buah', 'LIKE', '%' . $search . '%');
                  })
                  ->orWhereHas('supplier', function($q2) use ($search) {
                      $q2->where('nama_supplier', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        // 4. Eksekusi query
        $stoks = $query->latest()->get(); 
        
        return view('stok.index', compact('stoks'));
    }
    public function create(Request $request)
    {
        $selectedBuahId = $request->query('buah_id');
        $buahs = Buah::all();
        $gudangs = Gudang::all();
        $suppliers = Supplier::all(); 
        
        return view('stok.create', compact('buahs', 'gudangs', 'suppliers', 'selectedBuahId'));
    }

    public function store(Request $request)
{
    $request->validate([
        'buah_id' => 'required',
        'gudang_id' => 'required',
        'supplier_id' => 'required',
        'kode_batch' => 'required',
        'jumlah' => 'required|numeric',
        'tanggal_masuk' => 'required|date',
    ]);

    // 1. Ambil data buah untuk mendapatkan masa simpannya
    $buah = Buah::findOrFail($request->buah_id);

    // 2. Hitung estimasi kadaluarsa otomatis
    $tanggalMasuk = Carbon::parse($request->tanggal_masuk);
    $estimasiKadaluarsa = $tanggalMasuk->addDays($buah->estimasi_masa_simpan);

    // 3. Simpan ke database dengan estimasi yang sudah dihitung
    Stok::create([
        'buah_id' => $request->buah_id,
        'gudang_id' => $request->gudang_id,
        'supplier_id' => $request->supplier_id,
        'kode_batch' => $request->kode_batch,
        'jumlah' => $request->jumlah,
        'tanggal_masuk' => $request->tanggal_masuk,
        'estimasi_kadaluarsa' => $estimasiKadaluarsa, // <--- Ini yang menghilangkan error
        'status' => 'Aman',
    ]);

    return redirect()->route('buah.index')->with('success', 'Stok berhasil ditambahkan!');
}

    public function show(Stok $stok)
    {
        $stok->load(['buah', 'gudang', 'supplier']);
        return response()->json($stok);
    }

    public function edit(Stok $stok)
    {
        // return view('stok.edit', compact('stok'));
    }

    public function update(UpdateStokRequest $request, Stok $stok)
    {
        $data = $request->validated();
        
        // Cek jika ada input tanggal_masuk untuk update estimasi
        if (isset($data['tanggal_masuk']) && ($stok->buah_id != $data['buah_id'] || $stok->tanggal_masuk != $data['tanggal_masuk'])) {
            $buah = Buah::findOrFail($data['buah_id']);
            $tanggalMasuk = Carbon::parse($data['tanggal_masuk']);
            $data['estimasi_kadaluarsa'] = $tanggalMasuk->addDays($buah->estimasi_masa_simpan);
        }

        $stok->update($data);
        return redirect()->route('stok.index')->with('success', 'Stok berhasil diperbarui.');
    }

    public function destroy(Stok $stok)
    {
        $stok->delete();
        return redirect()->route('stok.index')->with('success', 'Stok berhasil dihapus.');
    }
}
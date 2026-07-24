<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Buah;
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateStokRequest;
use Carbon\Carbon; // Wajib dipanggil untuk manipulasi tanggal

class StokController extends Controller
{
    public function index()
    {
        // Eager loading 3 relasi sekaligus
        $stoks = Stok::with(['buah', 'gudang', 'supplier'])->get();
        return response()->json($stoks);
    }

    public function create()
    {
        // return view('stok.create');
    }

    public function store(StoreStokRequest $request)
    {
        $data = $request->validated();

        // 1. Generate Kode Batch otomatis (contoh: BCH-17032026-X)
        $data['kode_batch'] = 'BCH-' . time();

        // 2. Hitung Estimasi Kadaluarsa otomatis
        $buah = Buah::findOrFail($data['buah_id']);
        $tanggalMasuk = Carbon::parse($data['tanggal_masuk']);
        
        // Menambahkan hari sesuai masa simpan buah ke tanggal masuk
        $data['estimasi_kadaluarsa'] = $tanggalMasuk->addDays($buah->estimasi_masa_simpan);

        // 3. Set status default
        $data['status'] = 'Aman';

        Stok::create($data);
        return redirect()->route('stok.index')->with('success', 'Stok berhasil ditambahkan.');
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
        
        // Jika buah_id atau tanggal_masuk diubah, hitung ulang estimasi kadaluarsanya
        if ($stok->buah_id != $data['buah_id'] || $stok->tanggal_masuk != $data['tanggal_masuk']) {
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
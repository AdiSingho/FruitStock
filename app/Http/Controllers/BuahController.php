<?php

namespace App\Http\Controllers;

use App\Models\Buah;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBuahRequest;
use App\Http\Requests\UpdateBuahRequest;

class BuahController extends Controller
{
    public function index()
    {
        // Mengambil semua data buah dari database
        // with('kategori') adalah teknik Eager Loading untuk menghindari masalah N+1 Query
        $buahs = \App\Models\Buah::with('kategori')->get();
        
        // Mengirim data $buahs ke file view (tampilan)
        return view('buah.index', compact('buahs')); 
    }

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('buah.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'kategori_id' => 'required',
            'nama_buah' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'estimasi_masa_simpan' => 'required|numeric',
            'satuan' => 'required',
        ]);

        // 2. Simpan
        \App\Models\Buah::create($request->all());

        // 3. Redirect
        return redirect()->route('buah.index')->with('success', 'Buah berhasil ditambahkan!');
    }

    public function show(Buah $buah)
    {
        // Eager load juga saat melihat detail satu buah
        $buah->load('kategori');
        return response()->json($buah);
    }

        public function edit($id)
    {
        $buah = \App\Models\Buah::findOrFail($id);
        $kategoris = \App\Models\Kategori::all(); // Perlu untuk dropdown kategori
        return view('buah.edit', compact('buah', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        \App\Models\Buah::findOrFail($id)->update($request->all());
        return redirect()->route('buah.index')->with('success', 'Data buah berhasil diupdate!');
    }

    public function destroy($id)
    {
        \App\Models\Buah::findOrFail($id)->delete();
        return redirect()->route('buah.index')->with('success', 'Data buah berhasil dihapus!');
    }
}
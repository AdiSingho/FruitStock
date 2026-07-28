<?php

namespace App\Http\Controllers;

use App\Models\Buah;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBuahRequest;
use App\Http\Requests\UpdateBuahRequest;

class BuahController extends Controller
{
    public function index(Request $request)
    {
        // Memulai query dengan relasi kategori dan stoks
        $query = \App\Models\Buah::with(['kategori', 'stoks']);

        // Cek jika ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_buah', 'LIKE', '%' . $request->search . '%');
        }

        $buahs = $query->latest()->get();
        
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

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        // relasi 'kategori' dan 'stoks' dimuat (Eager Loading)
        $buahs = \App\Models\Buah::with(['kategori', 'stoks'])
                    ->where('nama_buah', 'LIKE', '%' . $query . '%')
                    ->get();

        return response()->json($buahs);
    }
}
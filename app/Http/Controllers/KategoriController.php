<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all(); // Mengambil data
        return view('kategori.index', compact('kategoris')); // Mengirim data
    }

    public function create()
    {
        // return view('kategori.create');
    }

   public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        // 2. Simpan ke database
        \App\Models\Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function show(Kategori $kategori)
    {
        //
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, $id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Data berhasil diubah!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Data berhasil dihapus!');
    }
}
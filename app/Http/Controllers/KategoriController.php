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
        $kategoris = Kategori::all();
        // return view('kategori.index', compact('kategoris'));
        return response()->json($kategoris); // Kita return JSON sementara untuk tes logika
    }

    public function create()
    {
        // return view('kategori.create');
    }

    public function store(StoreKategoriRequest $request)
    {
        // Data sudah otomatis tervalidasi oleh StoreKategoriRequest
        Kategori::create($request->validated());
        
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Kategori $kategori)
    {
        //
    }

    public function edit(Kategori $kategori)
    {
        // return view('kategori.edit', compact('kategori'));
    }

    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        // Data sudah otomatis tervalidasi oleh UpdateKategoriRequest
        $kategori->update($request->validated());
        
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
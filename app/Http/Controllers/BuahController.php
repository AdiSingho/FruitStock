<?php

namespace App\Http\Controllers;

use App\Models\Buah;
use App\Http\Requests\StoreBuahRequest;
use App\Http\Requests\UpdateBuahRequest;

class BuahController extends Controller
{
    public function index()
    {
        // PENTING UNTUK UAS: Menggunakan with() untuk Eager Loading relasi Kategori
        $buahs = Buah::with('kategori')->get();
        return response()->json($buahs);
    }

    public function create()
    {
        // return view('buah.create');
    }

    public function store(StoreBuahRequest $request)
    {
        Buah::create($request->validated());
        return redirect()->route('buah.index')->with('success', 'Data Buah berhasil ditambahkan.');
    }

    public function show(Buah $buah)
    {
        // Eager load juga saat melihat detail satu buah
        $buah->load('kategori');
        return response()->json($buah);
    }

    public function edit(Buah $buah)
    {
        // return view('buah.edit', compact('buah'));
    }

    public function update(UpdateBuahRequest $request, Buah $buah)
    {
        $buah->update($request->validated());
        return redirect()->route('buah.index')->with('success', 'Data Buah berhasil diperbarui.');
    }

    public function destroy(Buah $buah)
    {
        $buah->delete();
        return redirect()->route('buah.index')->with('success', 'Data Buah berhasil dihapus.');
    }
}
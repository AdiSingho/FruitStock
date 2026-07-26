<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGudangRequest;
use App\Http\Requests\UpdateGudangRequest;

class GudangController extends Controller
{
    public function index()
    {
        // Menggunakan with('stoks') agar data stok di gudang terbawa
        $gudangs = \App\Models\Gudang::with('stoks')->get();
        
        return view('gudang.index', compact('gudangs'));
    }

    public function create()
    {
        return view('gudang.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'kode_rak' => 'required',
            'kapasitas' => 'required|numeric',
            'keterangan' => 'nullable',
        ]);

        // 2. Simpan
        \App\Models\Gudang::create($request->all());

        // 3. Redirect
        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil ditambahkan!');
    }

    public function show(Gudang $gudang)
    {
        //
    }

        public function edit($id)
    {
        $gudang = \App\Models\Gudang::findOrFail($id);
        return view('gudang.edit', compact('gudang'));
    }

    public function update(Request $request, $id)
    {
        \App\Models\Gudang::findOrFail($id)->update($request->all());
        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil diupdate!');
    }

    public function destroy($id)
    {
        \App\Models\Gudang::findOrFail($id)->delete();
        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Http\Requests\StoreGudangRequest;
use App\Http\Requests\UpdateGudangRequest;

class GudangController extends Controller
{
    public function index()
    {
        $gudangs = Gudang::all();
        return response()->json($gudangs);
    }

    public function create()
    {
        // return view('gudang.create');
    }

    public function store(StoreGudangRequest $request)
    {
        Gudang::create($request->validated());
        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil ditambahkan.');
    }

    public function show(Gudang $gudang)
    {
        //
    }

    public function edit(Gudang $gudang)
    {
        // return view('gudang.edit', compact('gudang'));
    }

    public function update(UpdateGudangRequest $request, Gudang $gudang)
    {
        $gudang->update($request->validated());
        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil diperbarui.');
    }

    public function destroy(Gudang $gudang)
    {
        $gudang->delete();
        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil dihapus.');
    }
}
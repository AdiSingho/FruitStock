<?php
namespace App\Http\Controllers;

use App\Models\Buah;
use App\Http\Requests\StoreBuahRequest;
use App\Http\Requests\UpdateBuahRequest;

class BuahController extends Controller
{
    public function index() {
        $buahs = Buah::with('kategori')->get();
        return view('buah.index', compact('buahs'));
    }

    public function store(StoreBuahRequest $request) {
        Buah::create($request->validated());
        return redirect()->route('buah.index')->with('success', 'Data Buah berhasil ditambahkan.');
    }

    public function update(UpdateBuahRequest $request, Buah $buah) {
        $buah->update($request->validated());
        return redirect()->route('buah.index')->with('success', 'Data Buah berhasil diperbarui.');
    }

    public function destroy(Buah $buah) {
        $buah->delete();
        return redirect()->route('buah.index')->with('success', 'Data Buah berhasil dihapus.');
    }
}
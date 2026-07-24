<?php
namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Buah;
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateStokRequest;
use Carbon\Carbon;

class StokController extends Controller
{
    public function index() {
        $stoks = Stok::with(['buah', 'gudang', 'supplier'])->get();
        return view('stok.index', compact('stoks'));
    }

    public function store(StoreStokRequest $request) {
        $data = $request->validated();
        $data['kode_batch'] = 'BCH-' . time();
        $buah = Buah::findOrFail($data['buah_id']);
        $data['estimasi_kadaluarsa'] = Carbon::parse($data['tanggal_masuk'])->addDays($buah->estimasi_masa_simpan);
        $data['status'] = 'Aman';
        
        Stok::create($data);
        return redirect()->route('stok.index')->with('success', 'Stok berhasil ditambahkan.');
    }

    public function update(UpdateStokRequest $request, Stok $stok) {
        $data = $request->validated();
        if ($stok->buah_id != $data['buah_id'] || $stok->tanggal_masuk != $data['tanggal_masuk']) {
            $buah = Buah::findOrFail($data['buah_id']);
            $data['estimasi_kadaluarsa'] = Carbon::parse($data['tanggal_masuk'])->addDays($buah->estimasi_masa_simpan);
        }
        $stok->update($data);
        return redirect()->route('stok.index')->with('success', 'Stok berhasil diperbarui.');
    }

    public function destroy(Stok $stok) {
        $stok->delete();
        return redirect()->route('stok.index')->with('success', 'Stok berhasil dihapus.');
    }
}
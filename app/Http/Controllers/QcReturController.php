<?php

namespace App\Http\Controllers;

use App\Models\QcRetur;
use App\Models\Stok;
use App\Http\Requests\StoreQcReturRequest;
use App\Http\Requests\UpdateQcReturRequest;
use Illuminate\Support\Facades\DB;

class QcReturController extends Controller
{
    public function index()
    {
        $qcReturs = QcRetur::with(['stok.buah', 'user'])->get();
        return response()->json($qcReturs);
    }

    public function create()
    {
        // return view('qc-retur.create');
    }

    public function store(StoreQcReturRequest $request)
    {
        $data = $request->validated();
        
        DB::beginTransaction();
        try {
            // 1. Cek stok yang ada
            $stok = Stok::findOrFail($data['stok_id']);
            
            if ($stok->jumlah < $data['qty_rusak']) {
                throw new \Exception('Kuantitas rusak melebihi stok yang tersedia di batch ini.');
            }

            // 2. Kurangi stok fisik
            $stok->jumlah -= $data['qty_rusak'];
            $stok->save();

            // 3. Catat riwayat QC
            $data['user_id'] = auth()->id();
            $data['status'] = 'Selesai';
            
            QcRetur::create($data);

            DB::commit();
            return redirect()->route('qc-retur.index')->with('success', 'QC berhasil dicatat dan stok fisik telah disesuaikan.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['qty_rusak' => $e->getMessage()]);
        }
    }

    public function show(QcRetur $qcRetur)
    {
        $qcRetur->load(['stok.buah', 'user']);
        return response()->json($qcRetur);
    }

    public function edit(QcRetur $qcRetur)
    {
        // Fitur edit biasanya dinonaktifkan untuk dokumen QC demi audit, tapi kita biarkan kosong dulu
    }

    public function update(UpdateQcReturRequest $request, QcRetur $qcRetur)
    {
        //
    }

    public function destroy(QcRetur $qcRetur)
    {
        // 
    }
}
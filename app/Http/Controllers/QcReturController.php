<?php
namespace App\Http\Controllers;

use App\Models\QcRetur;
use App\Models\Stok;
use App\Http\Requests\StoreQcReturRequest;
use Illuminate\Support\Facades\DB;

class QcReturController extends Controller
{
    public function index() {
        $qcReturs = QcRetur::with(['stok.buah', 'user'])->get();
        return view('qc-retur.index', compact('qcReturs'));
    }

    public function store(StoreQcReturRequest $request) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $stok = Stok::findOrFail($data['stok_id']);
            if ($stok->jumlah < $data['qty_rusak']) throw new \Exception('Stok tidak cukup.');
            
            $stok->jumlah -= $data['qty_rusak'];
            $stok->save();
            
            $data['user_id'] = auth()->id();
            $data['status'] = 'Selesai';
            QcRetur::create($data);
            
            DB::commit();
            return redirect()->route('qc-retur.index')->with('success', 'QC dicatat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['qty_rusak' => $e->getMessage()]);
        }
    }
}
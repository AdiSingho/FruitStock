<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        // Mengambil data stok yang jumlahnya lebih dari 0
        // Kita gunakan eager loading ('buah') agar bisa menampilkan nama buah di layar kasir
        $stoks = Stok::with('buah')->where('jumlah', '>', 0)->get(); 
        
        return view('pos.index', compact('stoks'));
    }

    // Fungsi store() untuk proses checkout akan kita buat di langkah selanjutnya
}
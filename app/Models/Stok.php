<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    // Ganti guarded dengan fillable untuk keamanan data
    protected $fillable = [
        'buah_id', 
        'gudang_id',
        'supplier_id', 
        'kode_batch', 
        'jumlah', 
        'tanggal_masuk',         
        'estimasi_kadaluarsa',   
        'status'                 
    ];

    
    public function buah() 
    {
        return $this->belongsTo(Buah::class, 'buah_id');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
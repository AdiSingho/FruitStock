<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QcRetur extends Model
{
    use HasFactory;

    // Mengizinkan penyimpanan otomatis
    protected $fillable = [
        'stok_id', 
        'user_id', 
        'qty_rusak', 
        'alasan', 
        'tindakan', 
        'tanggal_qc', 
        'status'
    ];

    // Relasi ke tabel Stok
    public function stok()
    {
        return $this->belongsTo(Stok::class);
    }

    // Relasi ke tabel User (Petugas yang lapor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
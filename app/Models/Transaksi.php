<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // Hanya kolom yang ada di database Anda yang boleh diisi
    protected $fillable = [
        'tanggal_transaksi', 
        'total_harga', 
        'user_id'
    ];

    // Relasi ke detail transaksi
    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}
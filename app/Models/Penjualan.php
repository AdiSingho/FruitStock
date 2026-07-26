<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'total_harga',
        'bayar',
        'kembalian'
    ];

    // Relasi: Satu transaksi punya banyak detail
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
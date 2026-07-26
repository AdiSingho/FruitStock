<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penjualan_id',
        'stok_id',
        'jumlah',
        'harga_satuan',
        'subtotal'
    ];

    // Relasi balik ke Penjualan dan Stok
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function stok()
    {
        return $this->belongsTo(Stok::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buah extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Buah dimiliki oleh satu Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi: Buah memiliki banyak riwayat Stok (batch)
    public function stoks()
    {
        return $this->hasMany(Stok::class);
    }
}
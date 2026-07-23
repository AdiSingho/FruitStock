<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Stok ini milik satu Buah
    public function buah()
    {
        return $this->belongsTo(Buah::class);
    }

    // Relasi: Stok ini disimpan di satu Gudang
    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    // Relasi: Stok ini dipasok oleh satu Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
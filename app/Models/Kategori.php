<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Mengizinkan mass-assignment kecuali untuk kolom id
    protected $guarded = ['id'];

    // Relasi: Satu Kategori memiliki banyak Buah
    public function buahs()
    {
        return $this->hasMany(Buah::class);
    }
}
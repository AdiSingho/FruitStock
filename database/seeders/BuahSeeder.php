<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('buahs')->insert([
            [
                'kategori_id' => 1, 
                'nama_buah' => 'Mangga Harumanis', 
                'harga_beli' => 15000, 
                'harga_jual' => 25000, 
                'estimasi_masa_simpan' => 7, 
                'satuan' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 2, 
                'nama_buah' => 'Apel Fuji Premium', 
                'harga_beli' => 25000, 
                'harga_jual' => 35000, 
                'estimasi_masa_simpan' => 14, 
                'satuan' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
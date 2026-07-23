<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stoks')->insert([
            [
                'buah_id' => 1, // Mangga Harumanis
                'gudang_id' => 2, // RAK-B (Lokal)
                'supplier_id' => 2, // Petani Muda Jaya
                'kode_batch' => 'BCH-MNG-001',
                'jumlah' => 50.50,
                'tanggal_masuk' => Carbon::now()->subDays(2),
                'estimasi_kadaluarsa' => Carbon::now()->addDays(5),
                'status' => 'Aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'buah_id' => 2, // Apel Fuji
                'gudang_id' => 1, // RAK-A (Import)
                'supplier_id' => 1, // PT Segar Makmur
                'kode_batch' => 'BCH-APL-001',
                'jumlah' => 100.00,
                'tanggal_masuk' => Carbon::now()->subDays(1),
                'estimasi_kadaluarsa' => Carbon::now()->addDays(13),
                'status' => 'Aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
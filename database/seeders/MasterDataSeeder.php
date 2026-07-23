<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Seeding Data Kategori
        DB::table('kategoris')->insert([
            ['nama_kategori' => 'Buah Lokal'],
            ['nama_kategori' => 'Buah Import'],
            ['nama_kategori' => 'Parsel'],
        ]);

        // Seeding Data Gudang
        DB::table('gudangs')->insert([
            ['kode_rak' => 'RAK-A', 'kapasitas' => 100, 'keterangan' => 'Gudang Buah Import'],
            ['kode_rak' => 'RAK-B', 'kapasitas' => 200, 'keterangan' => 'Gudang Buah Lokal'],
        ]);

        // Seeding Data Supplier
        DB::table('suppliers')->insert([
            ['nama_supplier' => 'PT Segar Makmur', 'alamat' => 'Jakarta Selatan', 'no_hp' => '08123456789'],
            ['nama_supplier' => 'Petani Muda Jaya', 'alamat' => 'Bandung', 'no_hp' => '08987654321'],
        ]);
    }
}
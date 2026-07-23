<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Utama', 
                'email' => 'admin@fruitstock.com', 
                'password' => Hash::make('password123'), 
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas Gudang', 
                'email' => 'gudang@fruitstock.com', 
                'password' => Hash::make('password123'), 
                'role' => 'gudang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasir Toko', 
                'email' => 'kasir@fruitstock.com', 
                'password' => Hash::make('password123'), 
                'role' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
@extends('layouts.main')

@section('title', 'Beranda - FruitStock')

@section('main-content')
<div class="mb-8 flex justify-between items-end">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Beranda</h1>
        <p class="text-gray-500 mt-1">Ringkasan status gudang hari ini.</p>
    </div>
    <a href="#" class="bg-fruit-green hover:bg-green-800 text-white px-5 py-2.5 rounded-lg font-medium flex items-center transition-colors shadow-sm">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Stok
    </a>
</div>

<!-- Grid 4 Card Ringkasan -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Card 1: Normal -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-md">Normal</span>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Total Stok</p>
        <h3 class="text-3xl font-bold text-gray-900">1,200 Kg</h3>
    </div>

    <!-- Card 2: Perhatian -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <span class="bg-orange-100 text-orange-700 text-xs font-semibold px-2.5 py-1 rounded-md">Perhatian</span>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Item Hampir Habis</p>
        <h3 class="text-3xl font-bold text-gray-900">15 Item</h3>
    </div>

    <!-- Card 3: Kritis -->
    <div class="bg-red-50 p-6 rounded-2xl shadow-sm border border-red-100 relative overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-red-200 text-red-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
            </div>
            <span class="bg-red-200 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-md">Kritis</span>
        </div>
        <p class="text-sm text-red-600 font-medium mb-1">Mendekati Busuk</p>
        <h3 class="text-3xl font-bold text-red-900">5 Item</h3>
    </div>

    <!-- Card 4: Penjualan -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-md">+12%</span>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Penjualan Hari Ini</p>
        <h3 class="text-3xl font-bold text-gray-900">Rp 4.5M</h3>
    </div>
</div>

<!-- Bagian Bawah: Tabel & Grafik -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Tabel Peringatan (Mengisi 2 Kolom) -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-900">Peringatan Stok Kritis & Expired</h3>
            <a href="#" class="text-sm font-medium text-fruit-green hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Item</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Sisa Stok</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Batas Waktu</th>
                        <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 flex items-center">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-xl mr-3">🍎</div>
                            <span class="font-medium text-gray-900">Apel Fuji</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">5 kg</td>
                        <td class="px-6 py-4 font-medium text-red-600">Hari Ini</td>
                        <td class="px-6 py-4 text-right">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                <span class="w-2 h-2 rounded-full bg-red-500 mr-1.5"></span> Kritis
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 flex items-center">
                            <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center text-xl mr-3">🍌</div>
                            <span class="font-medium text-gray-900">Pisang Sun</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">10 kg</td>
                        <td class="px-6 py-4 font-medium text-orange-600">Besok</td>
                        <td class="px-6 py-4 text-right">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                                <span class="w-2 h-2 rounded-full bg-orange-500 mr-1.5"></span> Menipis
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 flex items-center">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-xl mr-3">🥭</div>
                            <span class="font-medium text-gray-900">Mangga</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">50 kg</td>
                        <td class="px-6 py-4 text-gray-500">7 Hari</td>
                        <td class="px-6 py-4 text-right">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                <span class="w-2 h-2 rounded-full bg-green-500 mr-1.5"></span> Aman
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Grafik Visual (Mengisi 1 Kolom) -->
    <div class="bg-blue-50/50 rounded-2xl shadow-sm border border-blue-100 p-6 flex flex-col justify-between">
        <h3 class="text-lg font-bold text-gray-900 mb-6">Penjualan Mingguan</h3>
        <div class="flex-1 flex items-end justify-between space-x-2 h-40">
            <div class="w-full bg-blue-200 rounded-t-md h-1/3"></div>
            <div class="w-full bg-blue-200 rounded-t-md h-1/2"></div>
            <div class="w-full bg-blue-200 rounded-t-md h-2/3"></div>
            <div class="w-full bg-blue-200 rounded-t-md h-1/4"></div>
            <div class="w-full bg-fruit-green rounded-t-md h-full shadow-sm"></div>
            <div class="w-full bg-blue-200 rounded-t-md h-1/2"></div>
            <div class="w-full bg-blue-200 rounded-t-md h-2/5"></div>
        </div>
        <div class="flex justify-between mt-3 text-xs text-gray-500 font-medium">
            <span>Sn</span><span>Sl</span><span>Rb</span><span>Km</span><span class="text-fruit-green font-bold">Jm</span><span>Sb</span><span>Mg</span>
        </div>
    </div>
    
</div>
@endsection
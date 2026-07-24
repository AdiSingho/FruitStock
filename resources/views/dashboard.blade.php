@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-3xl font-bold text-[#0B1C30]">Beranda</h2>
        <p class="text-[#3C4A42]">Ringkasan status gudang hari ini.</p>
    </div>
    <a href="{{ route('stok.create') }}" 
        class="bg-[#006C49] text-white px-6 py-2 rounded-lg hover:bg-[#00573A] transition-colors">
        + Tambah Stok
    </a>
</div>

<!-- Summary Cards (Metrics Grid) -->
<div class="grid grid-cols-4 gap-6 mb-8">
    <div class="bg-[#F8F9FF] border border-[#BBCABF] p-6 rounded-xl">
        <p class="text-sm">Total Stok</p>
        <h3 class="text-2xl font-semibold">1,200 Kg</h3>
    </div>
    <div class="bg-[#F8F9FF] border border-[#BBCABF] p-6 rounded-xl">
        <p class="text-sm">Item Hampir Habis</p>
        <h3 class="text-2xl font-semibold">15 Item</h3>
    </div>
    <div class="bg-[#F8F9FF] border border-[#BBCABF] p-6 rounded-xl">
        <p class="text-sm">Mendekati Busuk</p>
        <h3 class="text-2xl font-semibold">5 Item</h3>
    </div>
    <div class="bg-[#F8F9FF] border border-[#BBCABF] p-6 rounded-xl">
        <p class="text-sm">Penjualan Hari Ini</p>
        <h3 class="text-2xl font-semibold">Rp 4.5M</h3>
    </div>
</div>

<!-- Bento Grid: Peringatan Stok & Grafik -->
<div class="grid grid-cols-3 gap-6">
    <!-- Peringatan Stok Kritis & Expired -->
    <div class="col-span-2 bg-[#F8F9FF] border border-[#BBCABF] rounded-xl p-6">
        <h3 class="font-semibold text-lg mb-4">Peringatan Stok Kritis & Expired</h3>
        <table class="w-full">
            <tr class="text-left text-xs uppercase text-[#3C4A42]">
                <th class="pb-4">Item</th>
                <th class="pb-4">Sisa Stok</th>
                <th class="pb-4">Batas Waktu</th>
                <th class="pb-4">Status</th>
            </tr>
            <tr>
                <td class="py-2">Apel Fuji</td>
                <td>5 kg</td>
                <td class="text-red-600">Hari Ini</td>
                <td><span class="bg-red-100 text-red-600 px-2 py-1 rounded">Kritis</span></td>
            </tr>
        </table>
    </div>

    <!-- Grafik Penjualan -->
    <div class="bg-[#F8F9FF] border border-[#BBCABF] rounded-xl p-6">
        <h3 class="font-semibold text-lg mb-4">Penjualan Mingguan</h3>
        <div class="h-40 flex items-end gap-2">
            <!-- Placeholder Bar Chart -->
            <div class="w-full h-1/2 bg-blue-200"></div>
            <div class="w-full h-3/4 bg-blue-200"></div>
            <div class="w-full h-full bg-[#006C49]"></div>
        </div>
    </div>
</div>
@endsection
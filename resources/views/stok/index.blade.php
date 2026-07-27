@extends('layouts.app')
@section('title', 'Stok & Gudang - FruitStock')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Gudang & Stok</h1>
    <!-- Tombol ini saya arahkan ke route tambah stok agar berfungsi -->
    <a href="{{ route('stok.create') }}" class="bg-fruit-green hover:bg-green-800 transition-colors text-white px-4 py-2 rounded-lg text-sm">
        + Tambah Stok Masuk
    </a>
</div>

<!-- Card Kapasitas (Simulasi desain UI Anda) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
        <h3 class="font-bold text-gray-700">Rak A - Buah Import</h3>
        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
            <div class="bg-red-500 h-2.5 rounded-full" style="width: 80%"></div>
        </div>
        <p class="text-xs text-gray-500 mt-2">Sisa ruang: 20 Pallet</p>
    </div>
</div>

<!-- ============================================== -->
<!-- AREA PENCARIAN (SEARCH BAR) DITAMBAHKAN DI SINI -->
<!-- ============================================== -->
<div class="mb-6">
    <form action="{{ route('stok.index') }}" method="GET" class="flex gap-2">
        <div class="relative w-full md:w-1/2">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <!-- Value request('search') menahan teks agar tidak hilang setelah dienter -->
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500" 
                   placeholder="Cari Kode Batch, Nama Buah, atau Supplier...">
        </div>
        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors">
            Cari
        </button>
        
        <!-- Tombol Reset hanya muncul saat mencari sesuatu -->
        @if(request('search'))
            <a href="{{ route('stok.index') }}" class="text-gray-700 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-colors flex items-center">
                Reset
            </a>
        @endif
    </form>
</div>

<!-- ============================================== -->
<!-- TABEL DATA (Diubah menjadi dinamis) -->
<!-- ============================================== -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500">ID Batch</th>
                <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500">Nama Buah</th>
                <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500">Tgl Masuk</th>
                <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500">Tgl Exp</th>
                <th class="px-6 py-4 text-xs font-semibold uppercase text-gray-500">Qty (Kg)</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <!-- LOOPING DATA DARI DATABASE -->
            @forelse($stoks as $stok)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-mono text-sm text-gray-600">{{ $stok->kode_batch }}</td>
                <td class="px-6 py-4 font-medium">{{ $stok->buah->nama_buah }}</td>
                <td class="px-6 py-4 text-gray-500">
                    {{ \Carbon\Carbon::parse($stok->tanggal_masuk)->format('d M Y') }}
                </td>
                <td class="px-6 py-4 font-bold text-red-600">
                    {{ \Carbon\Carbon::parse($stok->estimasi_kadaluarsa)->format('d M Y') }}
                </td>
                <td class="px-6 py-4 font-bold">{{ $stok->jumlah }}</td>
            </tr>
            @empty
            <!-- TAMPILAN JIKA DATA TIDAK DITEMUKAN / KOSONG -->
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    Tidak ada data stok ditemukan untuk "{{ request('search') }}".
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
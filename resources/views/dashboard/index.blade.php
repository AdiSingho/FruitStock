@extends('layouts.app')

@section('title', 'Beranda - FruitStock')

@section('content')
<div class="mb-8 flex justify-between items-end">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Beranda</h1>
        <p class="text-gray-500 mt-1">Ringkasan status gudang hari ini.</p>
    </div>
    <a href="{{ route('stok.create') }}" class="bg-fruit-green hover:bg-green-800 text-white px-5 py-2.5 rounded-lg font-medium flex items-center transition-colors shadow-sm">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Stok
    </a>
</div>

<!-- Grid 4 Card Ringkasan -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Card 1: Total Stok -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-md">Normal</span>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Total Stok</p>
        <h3 class="text-3xl font-bold text-gray-900">{{ number_format($totalStok) }} Kg</h3>
    </div>

    <!-- Card 2: Hampir Habis -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border {{ $itemHampirHabis > 0 ? 'border-orange-200' : 'border-gray-100' }}">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 {{ $itemHampirHabis > 0 ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }} rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            @if($itemHampirHabis > 0)
                <span class="bg-orange-100 text-orange-700 text-xs font-semibold px-2.5 py-1 rounded-md">Perhatian</span>
            @else
                <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-md">Aman</span>
            @endif
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Item Hampir Habis</p>
        <h3 class="text-3xl font-bold {{ $itemHampirHabis > 0 ? 'text-orange-600' : 'text-gray-900' }}">{{ $itemHampirHabis }} Item</h3>
    </div>

    <!-- Card 3: Kritis -->
    <div class="{{ $mendekatBusuk > 0 ? 'bg-red-50 border-red-100' : 'bg-white border-gray-100' }} p-6 rounded-2xl shadow-sm border">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 {{ $mendekatBusuk > 0 ? 'bg-red-200 text-red-600' : 'bg-green-100 text-green-600' }} rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
            </div>
            @if($mendekatBusuk > 0)
                <span class="bg-red-200 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-md">Kritis</span>
            @else
                <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-md">Aman</span>
            @endif
        </div>
        <p class="text-sm {{ $mendekatBusuk > 0 ? 'text-red-600' : 'text-gray-500' }} font-medium mb-1">Mendekati Busuk</p>
        <h3 class="text-3xl font-bold {{ $mendekatBusuk > 0 ? 'text-red-900' : 'text-gray-900' }}">{{ $mendekatBusuk }} Item</h3>
    </div>

    <!-- Card 4: Penjualan -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Penjualan Hari Ini</p>
        <h3 class="text-3xl font-bold text-gray-900">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h3>
    </div>
</div>

<!-- Bagian Bawah: Tabel -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-900">Peringatan Stok Kritis & Expired</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Item</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Sisa Stok</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Batas Waktu</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($stokKritis as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $item->buah->nama_buah }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $item->jumlah }} kg</td>
                    <td class="px-6 py-4 {{ \Carbon\Carbon::parse($item->estimasi_kadaluarsa)->isPast() ? 'text-red-600 font-bold' : 'text-orange-600' }}">
                        {{ \Carbon\Carbon::parse($item->estimasi_kadaluarsa)->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if(\Carbon\Carbon::parse($item->estimasi_kadaluarsa)->isPast())
                            <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold border border-red-200">Expired</span>
                        @elseif($item->jumlah <= 0)
                            <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold border border-red-200">Stok Habis</span>
                        @elseif(\Carbon\Carbon::parse($item->estimasi_kadaluarsa)->lte(\Carbon\Carbon::now()->addDays(3)))
                            <span class="bg-orange-100 text-orange-700 px-2.5 py-1 rounded-full text-xs font-semibold border border-orange-200">Mendekati Busuk</span>
                        @elseif($item->jumlah < 10)
                            <span class="bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-full text-xs font-semibold border border-yellow-200">Hampir Habis</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Semua stok aman dan terkendali.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('layouts.main')

@section('title', 'POS Kasir - FruitStock')

@section('main-content')
<div class="flex h-full gap-6">
    
    <!-- KOLOM KIRI: Katalog Produk -->
    <div class="flex-1 overflow-y-auto pr-2">
        <div class="mb-6 flex space-x-2">
            <button class="bg-fruit-green text-white px-5 py-2 rounded-lg font-medium text-sm">Semua</button>
            <button class="bg-white border text-gray-600 px-5 py-2 rounded-lg font-medium text-sm hover:border-fruit-green">Promo</button>
            <button class="bg-white border text-gray-600 px-5 py-2 rounded-lg font-medium text-sm hover:border-fruit-green">Lokal</button>
            <button class="bg-white border text-gray-600 px-5 py-2 rounded-lg font-medium text-sm hover:border-fruit-green">Import</button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Card Produk (Iterasi ini nanti dengan @foreach) -->
            <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all cursor-pointer">
                <div class="aspect-square bg-gray-100 rounded-lg mb-3 flex items-center justify-center text-gray-400">IMG</div>
                <h4 class="font-bold text-gray-900">Apel Fuji Premium</h4>
                <p class="text-sm text-gray-500 mb-2">Rp 35.000 / kg</p>
                <div class="text-xs font-bold text-fruit-green bg-green-50 px-2 py-1 rounded inline-block">Stok: 45kg</div>
            </div>
            
            <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all cursor-pointer opacity-75">
                <div class="aspect-square bg-gray-100 rounded-lg mb-3 flex items-center justify-center text-gray-400">IMG</div>
                <h4 class="font-bold text-gray-900">Pisang Sun</h4>
                <p class="text-sm text-gray-500 mb-2">Rp 15.000 / kg</p>
                <div class="text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded inline-block">Habis</div>
            </div>
        </div>
    </div>

    <!-- KOLOM KANAN: Keranjang (Sidebar) -->
    <div class="w-96 bg-white border-l border-gray-100 flex flex-col shrink-0">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold">🛒 Keranjang</h3>
            <button class="text-gray-400 hover:text-red-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
        </div>

        <!-- List Item -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4">
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="font-medium text-sm">Apel Fuji Premium</h4>
                    <p class="text-xs text-gray-500">Rp 35.000</p>
                </div>
                <div class="flex items-center space-x-3 bg-gray-50 rounded-lg p-1">
                    <button class="w-6 h-6 bg-white rounded shadow-sm text-gray-600">-</button>
                    <span class="text-sm font-bold">2.5</span>
                    <button class="w-6 h-6 bg-white rounded shadow-sm text-gray-600">+</button>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="p-6 border-t border-gray-100 bg-gray-50/50">
            <div class="space-y-2 mb-6">
                <div class="flex justify-between text-sm text-gray-500"><span>Subtotal</span><span>Rp 112.500</span></div>
                <div class="flex justify-between text-sm text-gray-500"><span>Pajak (11%)</span><span>Rp 12.375</span></div>
                <div class="flex justify-between text-lg font-bold"><span>Total</span><span>Rp 124.875</span></div>
            </div>
            <button class="w-full bg-fruit-green hover:bg-green-800 text-white py-4 rounded-xl font-bold transition-all shadow-lg shadow-green-200">
                BAYAR SEKARANG
            </button>
        </div>
    </div>
</div>
@endsection
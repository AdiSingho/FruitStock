@extends('layouts.main')
@section('title', 'Stok & Gudang - FruitStock')
@section('main-content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Gudang & Stok</h1>
    <button class="bg-fruit-green text-white px-4 py-2 rounded-lg text-sm">+ Tambah Stok Masuk</button>
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
            <tr>
                <td class="px-6 py-4 font-mono text-sm text-gray-600">BCH-1042</td>
                <td class="px-6 py-4 font-medium">Apel Fuji Premium</td>
                <td class="px-6 py-4 text-gray-500">12 Okt 2024</td>
                <td class="px-6 py-4 font-bold text-red-600">25 Nov 2024</td>
                <td class="px-6 py-4 font-bold">500.00</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
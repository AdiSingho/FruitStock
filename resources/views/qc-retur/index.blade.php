@extends('layouts.main')
@section('title', 'QC & Retur - FruitStock')
@section('main-content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Form QC -->
    <div class="lg:col-span-1">
        <h2 class="text-xl font-bold mb-4">Form Catatan Baru</h2>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <form>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Pilih Buah</label>
                    <select class="w-full border rounded-lg p-2.5">
                        <option>Pilih item buah...</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Kuantitas Rusak</label>
                    <input type="number" class="w-full border rounded-lg p-2.5" placeholder="0.00">
                </div>
                <button class="w-full bg-fruit-green text-white py-3 rounded-lg font-bold">SIMPAN CATATAN QC</button>
            </form>
        </div>
    </div>
    <!-- Riwayat QC -->
    <div class="lg:col-span-2">
        <h2 class="text-xl font-bold mb-4">Riwayat QC Terbaru</h2>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-xs uppercase text-gray-500">Tanggal</th>
                        <th class="px-6 py-3 text-xs uppercase text-gray-500">Buah</th>
                        <th class="px-6 py-3 text-xs uppercase text-gray-500">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr>
                        <td class="px-6 py-4 text-sm">20 Okt 2024</td>
                        <td class="px-6 py-4 font-medium">Mangga Harumanis</td>
                        <td class="px-6 py-4"><span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Buang</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
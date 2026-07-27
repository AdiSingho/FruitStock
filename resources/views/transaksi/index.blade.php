@extends('layouts.app')

@section('title', 'Riwayat Transaksi - FruitStock')

@section('content')

<!-- ================= MULAI BLOK NOTIFIKASI SUKSES & TOMBOL CETAK ================= -->
@if(session('success'))
<div class="mb-6 bg-green-50 border-l-4 border-fruit-green p-4 rounded-lg flex items-center justify-between shadow-sm">
    <div class="flex items-center">
        <svg class="w-6 h-6 text-fruit-green mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p class="text-green-800 font-medium">{{ session('success') }}</p>
    </div>
    
    <!-- Jika ada ID transaksi yang dikirim, munculkan tombol cetak besar -->
    @if(session('print_id'))
    <a href="{{ route('transaksi.print', session('print_id')) }}" target="_blank" class="bg-fruit-green hover:bg-green-800 text-white px-5 py-2 rounded-lg font-bold text-sm transition-colors flex items-center shadow-md animate-pulse">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
        CETAK STRUK SEKARANG
    </a>
    @endif
</div>
@endif
<!-- ================= AKHIR BLOK NOTIFIKASI ================= -->

<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Riwayat Transaksi</h2>
        <p class="text-sm text-gray-500">Daftar semua transaksi penjualan di toko.</p>
    </div>
    <div>
        <a href="{{ route('pos.index') }}" class="bg-fruit-green hover:bg-green-800 text-white px-4 py-2 rounded-lg font-medium text-sm transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Transaksi Baru (POS)
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-sm text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4 font-medium">No. Invoice</th>
                    <th class="px-6 py-4 font-medium">Tanggal</th>
                    <th class="px-6 py-4 font-medium">Total Harga</th>
                    <th class="px-6 py-4 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($transaksis as $transaksi)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900">INV-{{ $transaksi->id }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
                    <td class="px-6 py-4 text-gray-900 font-medium">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center">
                        <!-- Tombol Cetak Struk -->
                        <a href="{{ route('transaksi.print', $transaksi->id) }}" target="_blank" class="inline-flex items-center justify-center px-3 py-1.5 bg-gray-100 text-gray-700 hover:bg-fruit-green hover:text-white rounded-lg font-medium text-xs transition-colors border border-gray-200 hover:border-transparent">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak Struk
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        Belum ada riwayat transaksi saat ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
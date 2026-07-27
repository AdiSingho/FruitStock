@extends('layouts.app')

@section('title', 'Master Buah - FruitStock')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Master Data Buah</h1>
        <p class="text-gray-500">Daftar semua jenis buah yang tersedia.</p>
    </div>
    <a href="{{ route('buah.create') }}" class="bg-fruit-green hover:bg-green-800 text-white px-4 py-2 rounded-lg font-medium text-sm transition-colors">
    + Tambah Buah
    </a>
</div>


<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Nama Buah</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Kategori</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Harga Jual</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Satuan</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Total Stok</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($buahs as $buah)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $buah->nama_buah }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $buah->kategori->nama_kategori }}</td>
                <td class="px-6 py-4 text-gray-600">Rp {{ number_format($buah->harga_jual, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $buah->satuan }}</td>
                <td class="px-6 py-4 font-bold text-green-600">{{ $buah->stoks->sum('jumlah') }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('stok.create', ['buah_id' => $buah->id]) }}" class="text-green-600 hover:text-green-800 text-sm font-medium mr-2">+ Stok</a>
                    <a href="{{ route('buah.edit', $buah->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</a>
                    <form action="{{ route('buah.destroy', $buah->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
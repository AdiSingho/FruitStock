@extends('layouts.app')
@section('title', 'Gudang - FruitStock')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Data Gudang</h1>
    <a href="{{ route('gudang.create') }}" class="bg-fruit-green text-white px-4 py-2 rounded-lg text-sm transition-colors hover:bg-green-800">
    + Tambah Gudang
    </a>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Kode Rak</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Kapasitas</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Keterangan</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Total Stok</th>
                <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
        </thead>
            <tbody class="divide-y divide-gray-100">
            @foreach($gudangs as $gudang)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $gudang->kode_rak }}</td>
                <td class="px-6 py-4">{{ $gudang->kapasitas }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $gudang->keterangan }}</td>
                <td class="px-6 py-4 font-bold text-green-600">{{ $gudang->stoks->sum('jumlah') }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('gudang.edit', $gudang->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</a>
                    <form action="{{ route('gudang.destroy', $gudang->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
    </tbody>
    </table>
</div>
@endsection
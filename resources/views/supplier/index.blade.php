@extends('layouts.app')
@section('title', 'Supplier - FruitStock')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Data Supplier</h1>
    <a href="{{ route('supplier.create') }}" class="bg-fruit-green text-white px-4 py-2 rounded-lg text-sm transition-colors hover:bg-green-800">
    + Tambah Supplier
</a>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Nama Supplier</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Alamat</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">No HP</th>
                <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($suppliers as $supplier)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $supplier->nama_supplier }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $supplier->alamat }}</td>
                <td class="px-6 py-4">{{ $supplier->no_hp }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</a>
                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="inline">
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
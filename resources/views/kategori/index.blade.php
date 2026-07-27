@extends('layouts.app')

@section('title', 'Kategori - FruitStock')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Data Kategori</h1>
        <p class="text-gray-500">Kelola kategori buah untuk organisasi stok.</p>
    </div>
    <a href="{{ route('kategori.create') }}" class="bg-fruit-green hover:bg-green-800 text-white px-4 py-2 rounded-lg font-medium text-sm transition-colors">
    + Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
            </tr>
        </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($kategoris as $kategori)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-gray-600">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $kategori->nama_kategori }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                <!-- Link Edit -->
                <a href="{{ route('kategori.edit', $kategori->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</a>
                
                <!-- Form Hapus -->
                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="inline">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        Hapus
                    </button>
                </form>
            </td>
                </tr>
                @endforeach
    </tbody>
    </table>
</div>
@endsection
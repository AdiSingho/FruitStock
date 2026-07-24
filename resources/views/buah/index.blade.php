@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-[#0B1C30]">Daftar Buah</h2>
    <a href="{{ route('buah.create') }}" class="bg-[#006C49] text-white px-4 py-2 rounded-lg hover:bg-[#00573A] transition">
        + Tambah Buah
    </a>
</div>

<div class="bg-white border border-[#BBCABF] rounded-xl overflow-hidden shadow-sm">
    <table class="w-full text-left border-collapse">
        <thead class="bg-[#EFF4FF]">
            <tr>
                <th class="p-4 border-b">Nama Buah</th>
                <th class="p-4 border-b">Kategori</th>
                <th class="p-4 border-b">Harga Jual</th>
                <th class="p-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($buahs as $buah)
            <tr class="hover:bg-gray-50">
                <td class="p-4 border-b">{{ $buah->nama_buah }}</td>
                <td class="p-4 border-b">{{ $buah->kategori->nama_kategori }}</td>
                <td class="p-4 border-b">Rp {{ number_format($buah->harga_jual, 0, ',', '.') }}</td>
                <td class="p-4 border-b">
                    <a href="{{ route('buah.edit', $buah->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                    <form action="{{ route('buah.destroy', $buah->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">Data belum tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
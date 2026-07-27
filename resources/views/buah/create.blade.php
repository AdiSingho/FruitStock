@extends('layouts.app')
@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
    <h2 class="text-xl font-bold mb-6">Tambah Buah</h2>
    <form action="{{ route('buah.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border rounded-lg p-3" required>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Buah</label>
            <input type="text" name="nama_buah" class="w-full border rounded-lg p-3" required>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Harga Beli</label>
                <input type="number" name="harga_beli" class="w-full border rounded-lg p-3" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Harga Jual</label>
                <input type="number" name="harga_jual" class="w-full border rounded-lg p-3" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Masa Simpan (Hari)</label>
            <input type="number" name="estimasi_masa_simpan" class="w-full border rounded-lg p-3" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Satuan (Contoh: kg, pcs, ikat)</label>
            <input type="text" name="satuan" class="w-full border rounded-lg p-3" required>
        </div>
        <button type="submit" class="w-full bg-fruit-green text-white py-3 rounded-lg font-bold">SIMPAN</button>
        
        <a href="{{ url()->previous() }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium text-sm transition-colors">
            Batal
        </a>
    </form>
</div>

@endsection
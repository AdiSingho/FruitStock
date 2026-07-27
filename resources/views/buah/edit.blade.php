@extends('layouts.app')
@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-sm border">
    <h2 class="text-xl font-bold mb-6">Edit Buah</h2>
    <form action="{{ route('buah.update', $buah->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium">Kategori</label>
            <select name="kategori_id" class="w-full border rounded-lg p-3">
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}" {{ $buah->kategori_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Nama Buah</label>
            <input type="text" name="nama_buah" value="{{ $buah->nama_buah }}" class="w-full border rounded-lg p-3">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Satuan (Contoh: kg, pcs)</label>
            <input type="text" name="satuan" value="{{ $buah->satuan }}" class="w-full border rounded-lg p-3" required>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div><label class="block text-sm font-medium">Harga Beli</label><input type="number" name="harga_beli" value="{{ $buah->harga_beli }}" class="w-full border rounded-lg p-3"></div>
            <div><label class="block text-sm font-medium">Harga Jual</label><input type="number" name="harga_jual" value="{{ $buah->harga_jual }}" class="w-full border rounded-lg p-3"></div>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold">UPDATE</button>

        <a href="{{ url()->previous() }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium text-sm transition-colors">
            Batal
        </a>
    </form>
</div>
@endsection
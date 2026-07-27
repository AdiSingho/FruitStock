@extends('layouts.app')
@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
    <h2 class="text-xl font-bold mb-6">Tambah Gudang</h2>
    <form action="{{ route('gudang.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Kode Rak</label>
            <input type="text" name="kode_rak" class="w-full border rounded-lg p-3" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Kapasitas</label>
            <input type="number" name="kapasitas" class="w-full border rounded-lg p-3" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Keterangan</label>
            <textarea name="keterangan" class="w-full border rounded-lg p-3"></textarea>
        </div>
        <button type="submit" class="w-full bg-fruit-green text-white py-3 rounded-lg font-bold">SIMPAN</button>
        <a href="{{ route('gudang.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium text-sm transition-colors">
            Batal
        </a>
    </form>
</div>
@endsection
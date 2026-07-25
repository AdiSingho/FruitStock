@extends('layouts.main')
@section('main-content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
    <h2 class="text-xl font-bold mb-6">Tambah Supplier</h2>
    <form action="{{ route('supplier.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Supplier</label>
            <input type="text" name="nama_supplier" class="w-full border rounded-lg p-3" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Alamat</label>
            <textarea name="alamat" class="w-full border rounded-lg p-3" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">No HP</label>
            <input type="text" name="no_hp" class="w-full border rounded-lg p-3" required>
        </div>
        <button type="submit" class="w-full bg-fruit-green text-white py-3 rounded-lg font-bold">SIMPAN</button>
    </form>
</div>
@endsection
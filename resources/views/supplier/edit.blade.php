@extends('layouts.main')
@section('main-content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-sm border">
    <h2 class="text-xl font-bold mb-6">Edit Supplier</h2>
    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium">Nama Supplier</label>
            <input type="text" name="nama_supplier" value="{{ $supplier->nama_supplier }}" class="w-full border rounded-lg p-3" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Alamat</label>
            <textarea name="alamat" class="w-full border rounded-lg p-3" required>{{ $supplier->alamat }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">No HP</label>
            <input type="text" name="no_hp" value="{{ $supplier->no_hp }}" class="w-full border rounded-lg p-3" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold">UPDATE</button>
    </form>
</div>
@endsection
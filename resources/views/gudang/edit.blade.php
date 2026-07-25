@extends('layouts.main')
@section('main-content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-sm border">
    <h2 class="text-xl font-bold mb-6">Edit Gudang</h2>
    <form action="{{ route('gudang.update', $gudang->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium">Kode Rak</label>
            <input type="text" name="kode_rak" value="{{ $gudang->kode_rak }}" class="w-full border rounded-lg p-3" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Kapasitas</label>
            <input type="number" name="kapasitas" value="{{ $gudang->kapasitas }}" class="w-full border rounded-lg p-3" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Keterangan</label>
            <textarea name="keterangan" class="w-full border rounded-lg p-3">{{ $gudang->keterangan }}</textarea>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold">UPDATE</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Tambah Stok - FruitStock')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Stok Baru</h1>
        <p class="text-gray-500">Masukkan detail batch stok untuk gudang.</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('stok.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Pilih Buah (Otomatis terpilih jika dari menu Master Buah) -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Buah</label>
                <select name="buah_id" class="w-full border border-gray-300 rounded-lg p-3">
                    @foreach($buahs as $buah)
                        <option value="{{ $buah->id }}" {{ (isset($selectedBuahId) && $selectedBuahId == $buah->id) ? 'selected' : '' }}>
                            {{ $buah->nama_buah }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Gudang -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Lokasi Gudang</label>
                <select name="gudang_id" class="w-full border border-gray-300 rounded-lg p-3" required>
                    @foreach($gudangs as $gudang)
                        <option value="{{ $gudang->id }}">{{ $gudang->kode_rak }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Kode Batch -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Kode Batch</label>
                <input type="text" name="kode_batch" class="w-full border border-gray-300 rounded-lg p-3" placeholder="Contoh: BATCH-001" required>
            </div>

            <!-- Jumlah -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Jumlah</label>
                <input type="number" step="any" name="jumlah" class="w-full border border-gray-300 rounded-lg p-3" placeholder="0" required>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-fruit-green text-white font-bold py-3 rounded-lg hover:bg-green-800 transition">
                    Simpan Stok
                </button>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Supplier</label>
                <select name="supplier_id" class="..." required>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="w-full border border-gray-300 rounded-lg p-3" required>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-sm border max-w-3xl mx-auto">
    <h2 class="text-xl font-bold mb-6">Catat Barang Rusak / Retur (QC)</h2>

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('qc-retur.store') }}" method="POST">
        @csrf

        <div class="space-y-4">
            <!-- Pilih Barang -->
            <div>
                <label class="block font-bold text-gray-700 mb-1">Pilih Batch Buah</label>
                <select name="stok_id" class="w-full border rounded-lg p-2" required>
                    <option value="">-- Pilih Stok --</option>
                    @foreach($stoks as $stok)
                        <option value="{{ $stok->id }}">
                            {{ $stok->buah->nama_buah }} (Batch: {{ $stok->kode_batch }}) - Sisa: {{ $stok->jumlah }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah & Tanggal -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Jumlah Rusak/Retur</label>
                    <input type="number" step="any" name="qty_rusak" class="w-full border rounded-lg p-2" required min="0.1">
                </div>
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Tanggal QC</label>
                    <input type="date" name="tanggal_qc" class="w-full border rounded-lg p-2" required value="{{ date('Y-m-d') }}">
                </div>
            </div>

            <!-- Tindakan & Status -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Tindakan</label>
                    <select name="tindakan" class="w-full border rounded-lg p-2" required>
                        <option value="buang">Dibuang (Busuk/Hancur)</option>
                        <option value="retur">Retur ke Supplier</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Status Laporan</label>
                    <select name="status" class="w-full border rounded-lg p-2" required>
                        <option value="Selesai">Selesai Diproses</option>
                        <option value="Menunggu">Menunggu Konfirmasi Supplier</option>
                    </select>
                </div>
            </div>

            <!-- Alasan -->
            <div>
                <label class="block font-bold text-gray-700 mb-1">Alasan Kerusakan</label>
                <textarea name="alasan" rows="3" class="w-full border rounded-lg p-2" required placeholder="Contoh: Buah terlalu matang, kemasan sobek, dll..."></textarea>
            </div>

        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700">
                Simpan & Potong Stok
            </button>
            <a href="{{ route('qc-retur.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
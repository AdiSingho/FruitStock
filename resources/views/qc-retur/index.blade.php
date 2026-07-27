@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- BAGIAN KIRI: Form Catatan Baru -->
    <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-sm border h-fit">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Form Catatan Baru</h2>

        <!-- Alert Pesan Sukses / Error -->
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded text-sm font-medium">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded text-sm font-medium">{{ session('success') }}</div>
        @endif

        <!-- Form Terhubung ke Controller -->
        <form action="{{ route('qc-retur.store') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Buah (Batch)</label>
                <select name="stok_id" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-green-600 focus:border-green-600" required>
                    <option value="">Pilih item buah...</option>
                    @foreach($stoks as $stok)
                        <option value="{{ $stok->id }}">{{ $stok->buah->nama_buah }} (Sisa: {{ $stok->jumlah }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Kuantitas Rusak</label>
                <input type="number" step="any" name="qty_rusak" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-green-600 focus:border-green-600" placeholder="0.00" required min="0.1">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Tindakan</label>
                <select name="tindakan" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-green-600 focus:border-green-600" required>
                    <option value="buang">Dibuang (Busuk/Hancur)</option>
                    <option value="retur">Retur ke Supplier</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Alasan</label>
                <textarea name="alasan" rows="2" class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-green-600 focus:border-green-600" required placeholder="Contoh: Terlalu matang..."></textarea>
            </div>

            <!-- Input tersembunyi agar form tetap rapi seperti desain asli Anda -->
            <input type="hidden" name="tanggal_qc" value="{{ date('Y-m-d') }}">
            <input type="hidden" name="status" value="Selesai">

            <button type="submit" class="w-full bg-[#006B4E] text-white font-bold py-3 rounded-lg hover:bg-green-800 transition shadow-md">
                SIMPAN CATATAN QC
            </button>
        </form>
    </div>

    <!-- BAGIAN KANAN: Riwayat QC -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border">
        <h2 class="text-xl font-bold mb-6 text-gray-800">Riwayat QC Terbaru</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b text-xs text-gray-500 uppercase font-bold tracking-wider">
                        <th class="pb-3">Tanggal</th>
                        <th class="pb-3">Buah & Batch</th>
                        <th class="pb-3 text-center">Qty</th>
                        <th class="pb-3">Status / Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($qcReturs as $qc)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($qc->tanggal_qc)->format('d M Y') }}</td>
                        
                        <td class="py-4">
                            <div class="text-sm font-bold text-gray-800">{{ $qc->stok->buah->nama_buah ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-400">Batch: {{ $qc->stok->kode_batch ?? '-' }}</div>
                        </td>
                        
                        <td class="py-4 text-sm font-bold text-center text-gray-700">{{ $qc->qty_rusak }}</td>
                        
                        <td class="py-4">
                            <!-- Label Warna Warni berdasarkan tindakan -->
                            @if($qc->tindakan == 'buang')
                                <span class="px-3 py-1 bg-red-100 text-red-600 rounded-md text-xs font-bold">Dibuang</span>
                            @else
                                <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-md text-xs font-bold">Retur</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-400 italic text-sm">
                            Belum ada riwayat pencatatan QC atau Retur.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
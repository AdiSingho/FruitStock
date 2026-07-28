@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm">
    <h2 class="text-2xl font-bold mb-6">Laporan Penjualan</h2>

    <!-- Form Filter & Tombol Cetak -->
    <form action="{{ route('laporan.index') }}" method="GET" class="flex gap-4 mb-6 items-center">
        <input type="date" name="start_date" value="{{ $tgl_mulai }}" class="border p-2 rounded">
        <input type="date" name="end_date" value="{{ $tgl_akhir }}" class="border p-2 rounded">
        <button type="submit" class="bg-fruit-green hover:bg-green-800 text-white px-4 py-2 rounded transition-colors">
            Filter
        </button>

        <a href="{{ route('laporan.cetak', ['start_date' => $tgl_mulai, 'end_date' => $tgl_akhir]) }}" 
           target="_blank" 
           class="bg-gray-700 hover:bg-gray-900 text-white px-4 py-2 rounded transition-colors flex items-center gap-2 ml-auto">
            🖨️ Cetak PDF / Printer
        </a>
    </form>

    <!-- Total Pendapatan -->
    <div class="bg-fruit-green-light p-4 rounded-lg mb-6 text-fruit-green font-bold text-xl">
        Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
    </div>

    <!-- Tabel -->
    <!-- Tabel -->
    <table class="w-full text-left">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-3">No Transaksi</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Detail Item (Buah & Qty)</th>
                <th class="p-3 text-right">Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop berdasarkan kelompok transaksi_id --}}
            @forelse($groupedTransaksi as $transaksi_id => $items)
            <tr class="border-b hover:bg-gray-50">
                <!-- ID Transaksi (Hanya Tampil 1 Kali) -->
                <td class="p-3 font-mono text-sm text-gray-700">
                    INV-{{ str_pad($transaksi_id, 4, '0', STR_PAD_LEFT) }}
                </td>
                
                <!-- Ambil tanggal dari item pertama di kelompok tersebut -->
                <td class="p-3">
                    {{ \Carbon\Carbon::parse($items->first()->transaksi->tanggal_transaksi)->format('d-m-Y H:i') }}
                </td>
                
                <!-- Looping nama buah di dalam 1 sel tabel -->
                <td class="p-3">
                    @foreach($items as $item)
                        <div class="text-sm mb-1 text-gray-600">
                            &bull; {{ $item->stok->buah->nama_buah ?? 'N/A' }} 
                            <span class="font-semibold">(Qty: {{ $item->qty }})</span>
                        </div>
                    @endforeach
                </td>
                
                <!-- Jumlahkan subtotal untuk keseluruhan struk ini -->
                <td class="p-3 text-right font-bold text-green-700">
                    Rp {{ number_format($items->sum('subtotal'), 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-3 text-center text-gray-500">Tidak ada data transaksi pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
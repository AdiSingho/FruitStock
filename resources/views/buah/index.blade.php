@extends('layouts.app')

@section('title', 'Master Buah - FruitStock')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Master Data Buah</h1>
        <p class="text-gray-500">Daftar semua jenis buah yang tersedia.</p>
    </div>
    <a href="{{ route('buah.create') }}" class="bg-fruit-green hover:bg-green-800 text-white px-4 py-2 rounded-lg font-medium text-sm transition-colors">
    + Tambah Buah
    </a>
</div>

<!-- Input Pencarian (AJAX) -->
<div class="mb-6">
    <input type="text" id="search-input" placeholder="🔍 Cari nama buah secara instan..." 
           class="w-full md:w-1/3 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 shadow-sm">
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Nama Buah</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Kategori</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Harga Jual</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Satuan</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Total Stok</th>
                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-right">Aksi</th>
            </tr>
        </thead>
        <!-- ID table-buah adalah target update AJAX -->
        <tbody id="table-buah" class="divide-y divide-gray-100">
            @forelse($buahs as $buah)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $buah->nama_buah }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $buah->kategori->nama_kategori }}</td>
                <td class="px-6 py-4 text-gray-600">Rp {{ number_format($buah->harga_jual, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $buah->satuan }}</td>
                <td class="px-6 py-4 font-bold text-green-600">{{ $buah->stoks->sum('jumlah') }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('stok.create', ['buah_id' => $buah->id]) }}" class="text-green-600 hover:text-green-800 text-sm font-medium mr-2">+ Stok</a>
                    <a href="{{ route('buah.edit', $buah->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</a>
                    <form action="{{ route('buah.destroy', $buah->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Script AJAX untuk Live Search -->
<script>
    document.getElementById('search-input').addEventListener('keyup', function() {
        let query = this.value;
        
        
        let url = "{{ route('buah.search') }}?query=" + encodeURIComponent(query);

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error('Response error: ' + response.status);
                return response.json();
            })
            .then(data => {
                let tbody = document.getElementById('table-buah');
                tbody.innerHTML = ''; 

                if (data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Data tidak ditemukan.</td></tr>';
                    return;
                }

                data.forEach(item => {
                    let totalStok = item.stoks.reduce((sum, stok) => sum + stok.jumlah, 0);
                    tbody.innerHTML += `
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">${item.nama_buah}</td>
                            <td class="px-6 py-4 text-gray-600">${item.kategori ? item.kategori.nama_kategori : '-'}</td>
                            <td class="px-6 py-4 text-gray-600">Rp ${new Intl.NumberFormat('id-ID').format(item.harga_jual)}</td>
                            <td class="px-6 py-4 text-gray-600">${item.satuan}</td>
                            <td class="px-6 py-4 font-bold text-green-600">${totalStok}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-xs text-gray-400 italic">Edit di view utama</span>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error ditemukan:', error));
    });
</script>
@endsection
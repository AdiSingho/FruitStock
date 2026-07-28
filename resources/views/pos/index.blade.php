@extends('layouts.app')

@section('title', 'Kasir (POS) - FruitStock')

@section('content')

<!-- PESAN SUKSES / ERROR -->
@if(session('success'))
<div class="mb-6 bg-green-100 p-4 rounded-lg flex items-center justify-between border-l-4 border-green-500 shadow-sm">
    <div>
        <p class="font-bold text-green-800">Berhasil!</p>
        <p class="text-green-700">{{ session('success') }}</p>
    </div>
    @if(session('print_id'))
    <a href="{{ route('pos.print', session('print_id')) }}" target="_blank" class="bg-white border-2 border-green-600 text-green-700 hover:bg-green-700 hover:text-white px-6 py-2 rounded-lg font-bold text-sm transition-colors flex items-center shadow">
        CETAK STRUK
    </a>
    @endif
</div>
@endif

@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
        <p class="font-bold">Gagal!</p>
        <p>{{ session('error') }}</p>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- BAGIAN KIRI: DAFTAR PRODUK -->
    <div class="md:col-span-2 bg-white p-6 rounded-2xl shadow-sm border">
        <h2 class="text-xl font-bold mb-6">Pilih Produk</h2>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($stoks as $stok)
            <div class="border p-4 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors border-gray-200" 
                 onclick="tambahKeKeranjang({{ $stok->id }}, '{{ $stok->buah->nama_buah }}', {{ $stok->buah->harga_jual }}, {{ $stok->jumlah }})">
                <div class="font-bold text-gray-800">{{ $stok->buah->nama_buah }}</div>
                <div class="text-xs text-gray-500 mb-2">Batch: {{ $stok->kode_batch }}</div>
                <div class="text-sm font-medium text-blue-600">Sisa Stok: {{ $stok->jumlah }} kg</div>
                <div class="mt-2 text-lg font-bold text-green-600">
                    Rp {{ number_format($stok->buah->harga_jual, 0, ',', '.') }}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- BAGIAN KANAN: KERANJANG -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border h-fit sticky top-6">
        <h2 class="text-xl font-bold mb-6">Keranjang</h2>
        <form action="{{ route('pos.store') }}" method="POST">
            @csrf
            <div id="keranjang-items" class="min-h-[150px] mb-4 space-y-3">
                <p class="text-gray-400 text-sm text-center italic mt-10" id="pesan-kosong">Keranjang masih kosong...</p>
            </div>

            <div class="border-t pt-4">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-bold text-gray-600">Total Harga:</span>
                    <span class="font-bold text-2xl text-green-600" id="tampilan-total">Rp 0</span>
                </div>
                
                <input type="hidden" name="total_harga" id="input-total-harga" value="0">
                
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Uang Bayar (Rp)</label>
                    <input type="number" name="bayar" class="w-full border border-gray-300 rounded-lg p-3 font-bold text-lg" required min="0">
                </div>
                
                <button type="submit" id="btn-bayar" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold disabled:bg-gray-400" disabled>
                    PROSES PEMBAYARAN
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let keranjang = {};
    let totalHarga = 0;

    function tambahKeKeranjang(stokId, namaBuah, harga, stokMaks) {
        if(keranjang[stokId]) {
            if(keranjang[stokId].qty < stokMaks) {
                keranjang[stokId].qty += 1;
                keranjang[stokId].subtotal = keranjang[stokId].qty * harga;
            } else {
                alert('Melebihi sisa stok!');
            }
        } else {
            keranjang[stokId] = {
                nama: namaBuah,
                harga: harga,
                qty: 1,
                subtotal: harga,
                max: parseFloat(stokMaks)
            };
        }
        renderKeranjang();
    }

    function ubahQty(stokId, nilaiBaru) {
        let qtyBaru = parseFloat(nilaiBaru);
        if (isNaN(qtyBaru) || qtyBaru <= 0) {
            delete keranjang[stokId];
        } else if (qtyBaru > keranjang[stokId].max) {
            alert('Jumlah melebihi stok!');
            keranjang[stokId].qty = keranjang[stokId].max;
        } else {
            keranjang[stokId].qty = qtyBaru;
        }
        if(keranjang[stokId]) {
            keranjang[stokId].subtotal = keranjang[stokId].qty * keranjang[stokId].harga;
        }
        renderKeranjang();
    }

    function renderKeranjang() {
        const keranjangItems = document.getElementById('keranjang-items');
        const pesanKosong = document.getElementById('pesan-kosong');
        const btnBayar = document.getElementById('btn-bayar');
        
        keranjangItems.innerHTML = '';
        totalHarga = 0;
        let adaBarang = false;

        for (let stokId in keranjang) {
            adaBarang = true;
            let item = keranjang[stokId];
            totalHarga += item.subtotal;

            keranjangItems.innerHTML += `
                <div class="flex items-center justify-between text-sm border-b pb-3">
                    <div class="flex-1">
                        <div class="font-bold text-gray-800">${item.nama}</div>
                        <div class="text-xs text-gray-500">@ Rp ${item.harga.toLocaleString('id-ID')}</div>
                    </div>
                    <div class="mx-3">
                        <input type="number" step="any" min="0" max="${item.max}" value="${item.qty}" 
                               class="w-16 border rounded text-center p-1 font-bold bg-gray-50 focus:bg-white"
                               onchange="ubahQty(${stokId}, this.value)">
                    </div>
                    <div class="font-bold text-green-600 w-24 text-right">
                        Rp ${item.subtotal.toLocaleString('id-ID')}
                    </div>
                    <input type="hidden" name="stok_id[]" value="${stokId}">
                    <input type="hidden" name="qty[]" value="${item.qty}">
                    <input type="hidden" name="harga_satuan[]" value="${item.harga}">
                    <input type="hidden" name="subtotal[]" value="${item.subtotal}">
                </div>
            `;
        }

        document.getElementById('tampilan-total').innerText = 'Rp ' + totalHarga.toLocaleString('id-ID');
        document.getElementById('input-total-harga').value = totalHarga;

        if(adaBarang) {
            btnBayar.disabled = false;
        } else {
            keranjangItems.appendChild(pesanKosong);
            btnBayar.disabled = true;
        }
    }
</script>
@endsection
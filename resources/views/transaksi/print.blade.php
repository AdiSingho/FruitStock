<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ $transaksi->id }}</title>
    <style>
        /* CSS khusus untuk print struk thermal */
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 80mm; /* Lebar standar kertas kasir thermal */
            margin: 0 auto;
            padding: 10px;
            font-size: 14px;
            color: #000;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .border-b {
            border-bottom: 1px dashed #000;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }
        .mb-2 { margin-bottom: 10px; }
        .mt-2 { margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 2px 0; vertical-align: top; }
        
        /* Sembunyikan elemen tertentu saat dicetak (seperti tombol cetak ulang) */
        @media print {
            .no-print { display: none; }
            body { width: 100%; padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center mb-2">
        <h2 style="margin: 0;">FruitStock</h2>
        <small>Inventory & POS</small><br>
        <small>{{ $transaksi->created_at->format('d-m-Y H:i:s') }}</small>
    </div>
    
    <div class="border-b">
        <small>No: INV-{{ $transaksi->id }}</small><br>
        <small>Kasir: {{ auth()->user()->name ?? 'Admin' }}</small>
    </div>
    
    <table class="border-b">
        <!-- CATATAN: Sesuaikan '$transaksi->details' dengan nama relasi di Model Anda -->
        @foreach($transaksi->details as $item)
        <tr>
            <td class="text-left" colspan="2"><strong>{{ $item->stok->buah->nama_buah ?? 'Buah' }}</strong></td>
        </tr>
        <tr>
            <td class="text-left">{{ $item->jumlah }} x {{ number_format($item->harga, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>
    
    <table class="border-b">
        <tr>
            <td class="text-left"><strong>Total</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong></td>
        </tr>
        <!-- Hapus bagian bayar & kembali di bawah jika sistem Anda tidak mencatat nominal uang pembeli -->
        <tr>
            <td class="text-left">Tunai</td>
            <td class="text-right">Rp {{ number_format($transaksi->bayar ?? $transaksi->total_harga, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-left">Kembali</td>
            <td class="text-right">Rp {{ number_format($transaksi->kembali ?? 0, 0, ',', '.') }}</td>
        </tr>
    </table>
    
    <div class="text-center mt-2">
        <p style="margin: 0;">Terima Kasih!</p>
        <small>Barang yang dibeli tidak dapat ditukar.</small>
    </div>
    
    <!-- Tombol ini hanya muncul di layar, hilang saat dicetak -->
    <div class="text-center mt-2 no-print" style="margin-top: 30px;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background: #006B4D; color: white; border: none; border-radius: 5px;">
            Cetak Ulang
        </button>
    </div>
</body>
</html>
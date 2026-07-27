<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk POS #{{ $penjualan->no_transaksi }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; width: 80mm; margin: 0 auto; padding: 10px; font-size: 14px; color: #000; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .border-b { border-bottom: 1px dashed #000; margin-bottom: 10px; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 2px 0; vertical-align: top; }
        @media print { .no-print { display: none; } body { width: 100%; padding: 0; } }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center border-b">
        <h2 style="margin: 0;">FruitStock</h2>
        <small>Inventory & POS</small><br>
        <small>{{ $penjualan->created_at->format('d-m-Y H:i:s') }}</small>
    </div>
    
    <div class="border-b">
        <small>No: {{ $penjualan->no_transaksi }}</small><br>
        <small>Kasir: {{ auth()->user()->name ?? 'Admin' }}</small>
    </div>
    
    <table class="border-b">
        @foreach($details as $item)
        <tr>
            <td class="text-left" colspan="2"><strong>{{ $item->nama_buah }}</strong></td>
        </tr>
        <tr>
            <td class="text-left">{{ $item->jumlah }} x {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
            <td class="text-right">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>
    
    <table class="border-b">
        <tr>
            <td class="text-left"><strong>Total</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td class="text-left">Tunai</td>
            <td class="text-right">Rp {{ number_format($penjualan->bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-left">Kembali</td>
            <td class="text-right">Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>
    
    <div class="text-center no-print" style="margin-top: 30px;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background: #006B4D; color: white; border: none; border-radius: 5px;">
            Cetak Ulang
        </button>
    </div>
</body>
</html>
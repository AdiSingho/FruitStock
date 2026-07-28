<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 24px; color: #166534; }
        .header p { margin: 5px 0; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        table th { background-color: #f2f2f2; font-weight: bold; }
        .total-row { font-weight: bold; background-color: #e6f4ea; }
        .footer { text-align: right; margin-top: 30px; }
        
        @media print {
            @page { margin: 1cm; }
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>FRUITSTOCK INVENTORY</h2>
        <p>Laporan Pendapatan Penjualan</p>
        <p>Periode: <strong>{{ date('d-m-Y', strtotime($tgl_mulai)) }}</strong> s/d <strong>{{ date('d-m-Y', strtotime($tgl_akhir)) }}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 30%;">No Transaksi</th>
                <th style="width: 35%;">Tanggal Transaksi</th>
                <th style="width: 30%; text-align: right;">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->no_transaksi ?? ($item->id ?? 'N/A') }}</td>
                <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                <td style="text-align: right;">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">Tidak ada data penjualan pada rentang tanggal ini.</td>
            </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">TOTAL PENDAPATAN :</td>
                <td style="text-align: right;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Tangerang, {{ date('d-m-Y') }}</p>
        <br><br><br>
        <p>_______________________</p>
        <p>Admin / Pemilik</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>
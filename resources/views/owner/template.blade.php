<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Reservasi {{ $bulan }} {{ $tahun }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; margin-top: 5px; }
        .info { margin-bottom: 20px; text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th { background-color: #f2f2f2; text-align: left; padding: 8px; border: 1px solid #ddd; }
        .table td { padding: 8px; border: 1px solid #ddd; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; text-align: right; font-size: 11px; }
        .summary { margin-top: 20px; padding-top: 10px; border-top: 1px solid #333; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN RESERVASI BULANAN</div>
        <div class="subtitle">Desa Danau Toba</div>
        <div class="info">Periode: {{ $bulan }} {{ $tahun }}</div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Paket Wisata</th>
                <th>Jumlah Peserta</th>
                <th class="text-right">Total Bayar</th>
                <th>Tanggal Reservasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservasis as $index => $reservasi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $reservasi['nama_pelanggan'] }}</td>
                <td>{{ $reservasi['nama_paket'] }}</td>
                <td>{{ $reservasi['jumlah_peserta'] }}</td>
                <td class="text-right">Rp {{ $reservasi['total_bayar'] }}</td>
                <td>{{ $reservasi['tgl_reservasi'] }}</td>
                <td>{{ $reservasi['status'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total Reservasi:</strong> {{ $total_reservasi }} transaksi</p>
        <p><strong>Total Pendapatan:</strong> Rp {{ $total_pendapatan }}</p>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
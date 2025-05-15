<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Reservasi {{ $no_nota }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; }
        .no-nota { font-size: 16px; margin-bottom: 20px; }
        .info-box { margin-bottom: 30px; }
        .info-item { margin-bottom: 5px; }
        .info-label { display: inline-block; width: 150px; font-weight: bold; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; }
        .signature { margin-top: 50px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">NOTA RESERVASI</div>
        <div class="no-nota">No: {{ $no_nota }}</div>
    </div>

    <div class="info-box">
        <div class="info-item">
            <span class="info-label">Nama Pelanggan</span>: {{ $nama_pelanggan }}
        </div>
        <div class="info-item">
            <span class="info-label">Tanggal Reservasi</span>: {{ $tgl_reservasi }}
        </div>
        <div class="info-item">
            <span class="info-label">Tanggal Mulai</span>: {{ $tgl_mulai }}
        </div>
        <div class="info-item">
            <span class="info-label">Tanggal Selesai</span>: {{ $tgl_selesai }}
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $nama_paket }} ({{ $jumlah_peserta }} orang)</td>
                <td class="text-right">{{ $jumlah_peserta }}</td>
                <td class="text-right">Rp {{ $harga_paket }}</td>
            </tr>
            <tr>
                <td colspan="2">Diskon: {{ $diskon }}</td>
                <td class="text-right">- Rp {{ $nilai_diskon }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Subtotal</strong></td>
                <td class="text-right"><strong>Rp {{ $subtotal }}</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong>Total Bayar</strong></td>
                <td class="text-right"><strong>Rp {{ $total_bayar }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="info-box">
        <div class="info-item">
            <span class="info-label">Metode Pembayaran</span>: {{ $metode_pembayaran }}
        </div>
        <div class="info-item">
            <span class="info-label">Status</span>: {{ $status }}
        </div>
    </div>

    <div class="signature">
        <p>Hormat kami,</p>
        <br><br><br>
        <p>_________________________</p>
        <p>Admin</p>
    </div>

    <div class="footer">
        Terima kasih telah melakukan reservasi paket wisata kami. Enjoy your vacation!!
    </div>
</body>
</html>
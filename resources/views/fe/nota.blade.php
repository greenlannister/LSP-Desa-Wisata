<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Reservasi {{ $no_nota }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 40px;
        }
        .kop-surat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-surat img {
            width: 100px;
            height: auto;
        }
        .kop-teks {
            flex: 1;
            text-align: center;
            font-weight: bold;
        }
        .kop-teks .nama-desa {
            font-size: 20px;
            text-transform: uppercase;
        }
        .kop-teks .judul-nota {
            font-size: 16px;
            margin-top: 5px;
        }

        .info-box {
            margin-bottom: 30px;
        }
        .info-item {
            margin-bottom: 5px;
        }
        .info-label {
            display: inline-block;
            width: 180px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature p {
            margin: 4px 0;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-style: italic;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <div class="kop-teks">
            <div class="nama-desa">Desa Wisata Danau Toba</div>
            <div class="judul-nota">NOTA RESERVASI</div>
            <div>No: {{ $no_nota }}</div>
        </div>
    </div>

    <div class="info-box">
        <div class="info-item">
            <span class="info-label">Nama Pelanggan</span>: {{ $nama_pelanggan }}
        </div>
        <div class="info-item">
            <span class="info-label">Tanggal Reservasi</span>: {{ $tgl_reservasi }}
        </div>
        <div class="info-item">
            <span class="info-label">Durasi Liburan</span>: {{ $jumlah_hari }} hari ({{ $tgl_mulai }} - {{ $tgl_selesai }})
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Rincian</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $nama_paket }}</td>
                <td class="text-right">{{ $jumlah_peserta }} orang × {{ $jumlah_hari }} hari</td>
                <td class="text-right">Rp {{ $harga_per_hari }}/hari</td>
                <td class="text-right">Rp {{ $harga_total_per_hari }}</td>
            </tr>
            <tr>
                <td colspan="3">Diskon ({{ $diskon }})</td>
                <td class="text-right">- Rp {{ $nilai_diskon }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Subtotal</strong></td>
                <td class="text-right"><strong>Rp {{ $subtotal }}</strong></td>
            </tr>
            <tr>
                <td colspan="3"><strong>Total Bayar</strong></td>
                <td class="text-right"><strong>Rp {{ $total_bayar }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="info-box">
        <div class="info-item">
            <span class="info-label">Metode Pembayaran</span>: {{ $jenis_pembayaran }}
        </div>
        <div class="info-item">
            <span class="info-label">Status</span>: {{ $status }}
        </div>
    </div>

    <div class="signature">
        <p>Hormat kami,</p>
        <br><br><br>
        <p><strong>PUTRI AULIA RAHMA</strong></p>
        <p>Owner Desa Wisata Danau Toba</p>
    </div>

    <div class="footer">
        Terima kasih telah melakukan reservasi di desa wisata kami. Selamat menikmati liburan Anda!
    </div>
</body>
</html>
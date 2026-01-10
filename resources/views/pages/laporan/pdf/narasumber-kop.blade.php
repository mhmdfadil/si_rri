<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Narasumber - RRI Lhokseumawe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }
        .kop-surat {
            border-bottom: 3px solid #000;
            padding: 10px 20px;
            margin-bottom: 20px;
        }
        .kop-header {
            display: table;
            width: 100%;
        }
        .kop-logo {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
            text-align: center;
        }
        .kop-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding: 0 20px;
        }
        .kop-text h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .kop-text h3 {
            margin: 2px 0;
            font-size: 14px;
            font-weight: bold;
        }
        .kop-text p {
            margin: 2px 0;
            font-size: 9px;
        }
        .content {
            padding: 0 20px;
        }
        .title {
            text-align: center;
            margin: 20px 0;
        }
        .title h1 {
            font-size: 14px;
            margin: 5px 0;
            text-decoration: underline;
        }
        .title p {
            font-size: 10px;
            margin: 3px 0;
        }
        .info-section {
            margin-bottom: 15px;
        }
        .info-section table {
            width: 100%;
        }
        .info-section td {
            padding: 2px 0;
            font-size: 10px;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table.data-table th {
            background-color: #333;
            color: white;
            padding: 6px 5px;
            text-align: left;
            font-size: 8px;
            font-weight: bold;
            border: 1px solid #000;
        }
        table.data-table td {
            padding: 4px 5px;
            border: 1px solid #ddd;
            font-size: 8px;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
            padding-right: 50px;
        }
        .signature p {
            margin: 2px 0;
            font-size: 10px;
        }
        .signature-space {
            height: 60px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 8px;
            color: #666;
        }
        .stats-box {
            background: #f5f5f5;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .stats-box table {
            width: 100%;
        }
        .stats-box td {
            padding: 3px 5px;
            font-size: 9px;
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <div class="kop-header">
            <div class="kop-logo">
                <!-- Logo placeholder - ganti dengan logo RRI -->
                <div style="width: 70px; height: 70px; background: #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;">
                    RRI
                </div>
            </div>
            <div class="kop-text">
                <h2>LEMBAGA PENYIARAN PUBLIK</h2>
                <h3>RADIO REPUBLIK INDONESIA</h3>
                <h3>STASIUN LHOKSEUMAWE</h3>
                <p>Jl. Sultan Iskandar Muda No. 75 Lhokseumawe - Aceh 24352</p>
                <p>Telp: (0645) 44444 | Email: lhokseumawe@rri.co.id | Website: www.rri.co.id</p>
            </div>
        </div>
    </div>

    <div class="content">
        <!-- Title -->
        <div class="title">
            <h1>LAPORAN DATA NARASUMBER</h1>
            <p>Per Tanggal: {{ now()->format('d F Y') }}</p>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <table>
                <tr>
                    <td style="width: 20%">Nomor Laporan</td>
                    <td style="width: 1%">:</td>
                    <td>LAP/NS/{{ now()->format('Y/m') }}/{{ str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <td>Tanggal Cetak</td>
                    <td>:</td>
                    <td>{{ now()->format('d F Y') }}</td>
                </tr>
            </table>
        </div>

        <!-- Statistics -->
        <div class="stats-box">
            <strong>STATISTIK:</strong>
            <table>
                <tr>
                    <td style="width: 25%"><strong>Total Narasumber:</strong></td>
                    <td style="width: 25%">{{ number_format($stats['total']) }} narasumber</td>
                    <td style="width: 25%"><strong>Narasumber Aktif:</strong></td>
                    <td style="width: 25%">{{ number_format($stats['total_aktif']) }} narasumber</td>
                </tr>
            </table>
        </div>

        <!-- Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 10%">Kode</th>
                    <th style="width: 25%">Nama Lengkap</th>
                    <th style="width: 20%">Instansi</th>
                    <th style="width: 17%">Jabatan</th>
                    <th style="width: 15%">Bidang Keahlian</th>
                    <th style="width: 10%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($narasumbers as $index => $item)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td>{{ $item->kode_narasumber }}</td>
                    <td>{{ $item->nama_lengkap_with_gelar }}</td>
                    <td>{{ $item->instansi ?? '-' }}</td>
                    <td>{{ $item->jabatan_instansi ?? '-' }}</td>
                    <td>{{ $item->bidang_keahlian ?? '-' }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Signature -->
        <div class="signature">
            <p>Lhokseumawe, {{ now()->format('d F Y') }}</p>
            <p><strong>Kepala Stasiun RRI Lhokseumawe</strong></p>
            <div class="signature-space"></div>
            <p><strong><u>__________________________</u></strong></p>
            <p>NIP. ____________________</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>--- Dokumen ini dicetak secara elektronik dan sah tanpa tanda tangan ---</p>
            <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }} WIB</p>
        </div>
    </div>
</body>
</html>
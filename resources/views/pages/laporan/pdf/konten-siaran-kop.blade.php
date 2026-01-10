<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Konten Siaran - RRI Lhokseumawe</title>
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
            <h1>LAPORAN KONTEN SIARAN</h1>
            @if($filters['tanggal_dari'] && $filters['tanggal_sampai'])
            <p>Periode: {{ \Carbon\Carbon::parse($filters['tanggal_dari'])->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($filters['tanggal_sampai'])->format('d F Y') }}</p>
            @else
            <p>Per Tanggal: {{ now()->format('d F Y') }}</p>
            @endif
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <table>
                <tr>
                    <td style="width: 20%">Nomor Laporan</td>
                    <td style="width: 1%">:</td>
                    <td>LAP/{{ now()->format('Y/m') }}/{{ str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <td>Tanggal Cetak</td>
                    <td>:</td>
                    <td>{{ now()->format('d F Y') }}</td>
                </tr>
                @if($filters['status'])
                <tr>
                    <td>Filter Status</td>
                    <td>:</td>
                    <td>{{ ucfirst($filters['status']) }}</td>
                </tr>
                @endif
            </table>
        </div>

        <!-- Statistics -->
        <div class="stats-box">
            <strong>STATISTIK:</strong>
            <table>
                <tr>
                    <td style="width: 25%"><strong>Total Konten:</strong></td>
                    <td style="width: 25%">{{ number_format($stats['total']) }} konten</td>
                    <td style="width: 25%"><strong>Total Durasi:</strong></td>
                    <td style="width: 25%">{{ number_format($stats['total_durasi']) }} menit ({{ number_format($stats['total_durasi'] / 60, 1) }} jam)</td>
                </tr>
            </table>
        </div>

        <!-- Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 9%">Kode</th>
                    <th style="width: 28%">Judul</th>
                    <th style="width: 15%">Program</th>
                    <th style="width: 10%">Tanggal</th>
                    <th style="width: 7%">Jam</th>
                    <th style="width: 7%">Durasi</th>
                    <th style="width: 10%">Tipe</th>
                    <th style="width: 11%">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kontenSiaran as $index => $item)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    <td>{{ $item->kode_konten }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->program->nama_program ?? '-' }}</td>
                    <td>{{ $item->tanggal_siaran->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->jam_siaran)->format('H:i') }}</td>
                    <td style="text-align: center">{{ $item->durasi }}'</td>
                    <td>{{ ucfirst($item->tipe_siaran) }}</td>
                    <td>{{ $item->status_text }}</td>
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
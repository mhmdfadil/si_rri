<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Konten Siaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            margin: 5px 0;
        }
        .header p {
            font-size: 11px;
            margin: 3px 0;
        }
        .info {
            margin-bottom: 15px;
            background: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
        }
        .info table {
            width: 100%;
        }
        .info td {
            padding: 3px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #4F46E5;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
        }
        td {
            padding: 6px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 9px;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 9px;
        }
        .stats {
            display: inline-block;
            background: #EEF2FF;
            padding: 5px 10px;
            border-radius: 3px;
            margin-right: 10px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN KONTEN SIARAN</h1>
        <p>RRI Lhokseumawe</p>
        <p>Periode: {{ now()->format('d F Y') }}</p>
    </div>

    <!-- Statistics -->
    <div class="info">
        <table>
            <tr>
                <td style="width: 30%"><strong>Total Konten:</strong></td>
                <td>{{ number_format($stats['total']) }} konten</td>
                <td style="width: 30%"><strong>Total Durasi:</strong></td>
                <td>{{ number_format($stats['total_durasi']) }} menit</td>
            </tr>
        </table>
    </div>

    <!-- Data Table -->
    <table>
        <thead>
            <tr>
                <th style="width: 4%">No</th>
                <th style="width: 10%">Kode</th>
                <th style="width: 25%">Judul</th>
                <th style="width: 15%">Program</th>
                <th style="width: 10%">Tanggal</th>
                <th style="width: 8%">Jam</th>
                <th style="width: 8%">Durasi</th>
                <th style="width: 10%">Tipe</th>
                <th style="width: 10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kontenSiaran as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kode_konten }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->program->nama_program ?? '-' }}</td>
                <td>{{ $item->tanggal_siaran->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->jam_siaran)->format('H:i') }}</td>
                <td>{{ $item->durasi }} mnt</td>
                <td>{{ ucfirst($item->tipe_siaran) }}</td>
                <td>{{ $item->status_text }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>
</body>
</html>
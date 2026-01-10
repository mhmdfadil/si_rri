<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Narasumber</title>
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
            background-color: #10B981;
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
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN DATA NARASUMBER</h1>
        <p>RRI Lhokseumawe</p>
        <p>Periode: {{ now()->format('d F Y') }}</p>
    </div>

    <!-- Statistics -->
    <div class="info">
        <table>
            <tr>
                <td style="width: 30%"><strong>Total Narasumber:</strong></td>
                <td>{{ number_format($stats['total']) }} narasumber</td>
                <td style="width: 30%"><strong>Narasumber Aktif:</strong></td>
                <td>{{ number_format($stats['total_aktif']) }} narasumber</td>
            </tr>
        </table>
    </div>

    <!-- Data Table -->
    <table>
        <thead>
            <tr>
                <th style="width: 4%">No</th>
                <th style="width: 10%">Kode</th>
                <th style="width: 25%">Nama Lengkap</th>
                <th style="width: 20%">Instansi</th>
                <th style="width: 15%">Jabatan</th>
                <th style="width: 16%">Bidang Keahlian</th>
                <th style="width: 10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($narasumbers as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
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

    <!-- Footer -->
    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>
</body>
</html>
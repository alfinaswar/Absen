<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-logo {
            height: 60px;
            margin-bottom: 10px;
        }

        .report-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #1f497d;
        }

        .report-subtitle {
            font-size: 16px;
            margin-bottom: 15px;
            color: #666;
        }

        .report-period {
            font-size: 14px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        th {
            background-color: #1f497d;
            color: white;
            font-weight: bold;
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .ontime {
            color: #008000;
            font-weight: bold;
        }

        .late {
            color: #FF0000;
            font-weight: bold;
        }

        .approved {
            color: #008000;
        }

        .pending {
            color: #FFA500;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }

        .summary-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .summary-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #1f497d;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .summary-item {
            text-align: center;
            padding: 10px;
            background-color: white;
            border: 1px solid #eee;
            border-radius: 4px;
        }

        .summary-label {
            font-size: 12px;
            color: #666;
        }

        .summary-value {
            font-size: 20px;
            font-weight: bold;
            margin: 5px 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="/api/placeholder/200/60" alt="Company Logo" class="company-logo" />
        <div class="report-title">LAPORAN ABSENSI KARYAWAN</div>
        <div class="report-subtitle">PT. EXAMPLE CORPORATION</div>
        <div class="report-period">Periode: {{ $request->start_date ?? '01/05/2025' }} sampai
            {{ $request->end_date ?? '14/05/2025' }}
        </div>
    </div>



    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Shift</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Status Masuk</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td style="text-align: left;">{{ $item->nama_karyawan }}</td>
                    <td style="text-align: left;">{{ $item->NamaShifitMasuk }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $item->jam_masuk }}</td>
                    <td>{{ $item->jam_keluar ?? '-' }}</td>
                    <td class="{{ $item->ontime_masuk == 'Y' ? 'ontime' : 'late' }}">
                        {{ $item->ontime_masuk == 'Y' ? 'Tepat Waktu' : 'Terlambat' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data absensi untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dihasilkan secara otomatis oleh Sistem Absensi PT. Example Corporation</p>
        <p>Tanggal cetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>

</html>
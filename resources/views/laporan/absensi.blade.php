<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Absensi</h2>
    <p>Periode: {{ $request->start_date }} sampai {{ $request->end_date }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Ontime</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absenData as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->jam_masuk }}</td>
                    <td>{{ $data->jam_keluar }}</td>
                    <td>{{ $data->ontime ? 'Ontime' : 'Terlambat' }}</td>
                    <td>{{ $data->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada data absensi untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>

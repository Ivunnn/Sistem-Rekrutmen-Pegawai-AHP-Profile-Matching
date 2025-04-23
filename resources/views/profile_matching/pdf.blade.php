<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%; border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000; padding: 8px; text-align: left;
        }
    </style>
</head>
<body>
    <h3>Laporan Hasil Profile Matching</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Bagian Dilamar</th>
                <th>Total Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
            <tr>
                <td>{{ $result->pegawai->name }}</td>
                <td>{{ $result->pegawai->bagian_dilamar }}</td>
                <td>{{ number_format($result->total_score, 4) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

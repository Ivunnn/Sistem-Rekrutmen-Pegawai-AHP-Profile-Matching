<!DOCTYPE html>
<html>
<head>
    <title>Laporan Hasil Profile Matching</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <h1>Laporan Hasil Perhitungan Profile Matching</h1>
    <p>Tanggal: {{ date('d/m/Y') }}</p>
    
    <h3>Peringkat Kandidat</h3>
    <table>
        <thead>
            <tr>
                <th>Peringkat</th>
                <th>Nama Pegawai</th>
                <th>Posisi</th>
                <th>Nilai CF</th>
                <th>Nilai SF</th>
                <th>Nilai Total</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasil as $item)
                <tr>
                    <td>{{ $item['ranking'] }}</td>
                    <td>{{ $item['pegawai']->name }}</td>
                    <td>{{ $item['pegawai']->bagian_dilamar }}</td>
                    <td>{{ number_format($item['nilai_cf'], 2) }}</td>
                    <td>{{ number_format($item['nilai_sf'], 2) }}</td>
                    <td>{{ number_format($item['nilai_total'], 2) }}</td>
                    <td>{{ number_format($item['nilai_akhir'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="page-break"></div>
    
    <h3>Detail Perhitungan</h3>
    @foreach($hasil as $item)
        <div style="margin-bottom: 20px;">
            <h4>{{ $item['pegawai']->name }} - {{ $item['pegawai']->bagian_dilamar }}</h4>
            <table>
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Nilai Ideal</th>
                        <th>Nilai Aktual</th>
                        <th>GAP</th>
                        <th>Bobot GAP</th>
                        <th>Tipe Faktor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($item['detail_perhitungan'] as $kriteria_id => $hasil_kriteria)
                        <tr>
                            <td>{{ $hasil_kriteria['kriteria_nama'] }}</td>
                            <td>{{ $hasil_kriteria['nilai_ideal'] }}</td>
                            <td>{{ $hasil_kriteria['nilai_aktual'] }}</td>
                            <td>{{ $hasil_kriteria['gap'] }}</td>
                            <td>{{ $hasil_kriteria['bobot_gap'] }}</td>
                            <td>{{ $hasil_kriteria['tipe_faktor'] == 'core' ? 'Core Factor' : 'Secondary Factor' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <p>Nilai Core Factor (CF): {{ number_format($item['nilai_cf'], 2) }}</p>
            <p>Nilai Secondary Factor (SF): {{ number_format($item['nilai_sf'], 2) }}</p>
            <p>Nilai Total (60% CF + 40% SF): {{ number_format($item['nilai_total'], 2) }}</p>
            <p>Nilai Akhir (dengan Bobot AHP): {{ number_format($item['nilai_akhir'], 2) }}</p>
            <p>Peringkat: {{ $item['ranking'] }}</p>
            
            <hr>
        </div>
    @endforeach
    
    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
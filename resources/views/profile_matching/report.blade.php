@extends('adminlte::page')

@section('title', 'Pelaporan Profile Matching')

@section('content_header')
<div class="container-fluid">
    <h3>Laporan Hasil Profile Matching</h3>
    <a href="{{ route('profile-matching.pdf') }}" class="btn btn-danger mb-3">Download PDF</a>
    <table class="table table-bordered">
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
</div>
@endsection

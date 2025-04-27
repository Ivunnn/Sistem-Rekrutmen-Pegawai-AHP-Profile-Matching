@extends('adminlte::page')

@section('title', 'Hasil Profile Matching')

@section('content_header')
    <h1>Hasil Perhitungan Profile Matching</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Peringkat Kandidat</h3>
        <div class="card-tools">
            <a href="{{ route('profile-matching.pdf') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(count($hasil) > 0)
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Nama Pegawai</th>
                        <th>Posisi</th>
                        <th>Nilai CF</th>
                        <th>Nilai SF</th>
                        <th>Nilai Total</th>
                        <th>Nilai Akhir</th>
                        <th>Aksi</th>
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
                            <td>
                                <a href="{{ route('profile-matching.show', $item['pegawai']->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">
                Belum ada data nilai aktual yang lengkap untuk melakukan perhitungan profile matching.
            </div>
        @endif
    </div>
</div>
@stop
@extends('adminlte::page')

@section('title', 'Manajemen Nilai Aktual')

@section('content_header')
<h3>Detail Nilai Aktual - {{ $pegawai->name }}</h3>
<a href="{{ route('nilai-aktual.edit', $pegawai->id) }}" class="btn btn-warning mb-3">Edit Nilai</a>
<a href="{{ route('nilai-aktual.index') }}" class="btn btn-secondary mb-3">
    Kembali
</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kriteria</th>
            <th>Nilai Aktual</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kriterias as $kriteria)
        <tr>
            <td>{{ $kriteria->nama }}</td>
            <td>{{ $nilai_aktuals[$kriteria->id]->nilai ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

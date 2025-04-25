@extends('adminlte::page')

@section('title', 'Berkas Pelamar')

@section('content_header')

<div class="container-fluid">
    <h3>Data Berkas Anda</h3>

    @if ($berkas)
        <ul>
            <li>Nama: {{ $berkas->nama }}</li>
            <li>Bagian: {{ $berkas->bagian }}</li>
            <li>Pendidikan: {{ $berkas->pendidikan }}</li>
            <li>Sertifikat: {{ $berkas->sertifikat_pendukung ?? 'Tidak ada' }}</li>
            <li>CV: <a href="{{ asset('storage/' . $berkas->cv) }}" target="_blank">Lihat CV</a></li>
        </ul>
    @else
        <p>Belum ada data berkas.</p>
        <a href="{{ route('berkas.create') }}" class="btn btn-primary">Tambah Data Berkas</a>
    @endif
</div>
@endsection

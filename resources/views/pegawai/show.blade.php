@extends('adminlte::page')

@section('title', 'Detail Pegawai')

@section('content_header')
<h2>Detail Pegawai</h2>
<div class="pull-right">
    <a class="btn btn-secondary" href="{{ route('pegawai.index') }}">Kembali</a>
    <a class="btn btn-primary" href="{{ route('pegawai.edit', $pegawai->id) }}">Edit</a>
</div>
@stop

@section('content')

<section class="content">
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover table-striped">
                <tr>
                    <td><strong>No Peserta</strong></td>
                    <td>{{ $pegawai->no_peserta }}</td>
                </tr>
                <tr>
                    <td><strong>Nama</strong></td>
                    <td>{{ $pegawai->name }}</td>
                </tr>
                <tr>
                    <td><strong>Bagian yang Dilamar</strong></td>
                    <td>{{ $pegawai->bagian_dilamar }}</td>
                </tr>
                <tr>
                    <td><strong>Pendidikan</strong></td>
                    <td>{{ $pegawai->pendidikan }}</td>
                </tr>
                <tr>
                    <td><strong>Pengalaman Kerja</strong></td>
                    <td>{{ $pegawai->pengalaman_kerja }}</td>
                </tr>
                <tr>
                    <td><strong>Wawancara</strong></td>
                    <td>{{ $pegawai->wawancara }}</td>
                </tr>
                <tr>
                    <td><strong>Sertifikasi Pendukung</strong></td>
                    <td>{{ $pegawai->sertifikasi_pendukung }}</td>
                </tr>
                <tr>
                    <td><strong>Kemampuan</strong></td>
                    <td>{{ $pegawai->kemampuan }}</td>
                </tr>
                <tr>
                    <td><strong>CV</strong></td>
                    <td>
                        @if($pegawai->cv)
                            <a href="{{ asset('storage/cv/' . $pegawai->cv) }}" target="_blank">Lihat CV</a>
                        @else
                            Tidak ada file CV
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
</section>

@endsection

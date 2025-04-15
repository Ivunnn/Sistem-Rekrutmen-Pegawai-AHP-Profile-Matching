@extends('adminlte::page')

@section('title', 'Edit Data Pegawai')

@section('content_header')
    <h2>Edit Data Pegawai</h2>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="no_peserta" class="form-label">No Peserta</label>
                    <input type="text" name="no_peserta" class="form-control" value="{{ $pegawai->no_peserta }}" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $pegawai->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="bagian_dilamar" class="form-label">Bagian Dilamar</label>
                    <input type="text" name="bagian_dilamar" class="form-control" value="{{ $pegawai->bagian_dilamar }}" required>
                </div>

                <div class="mb-3">
                    <label for="pendidikan" class="form-label">Pendidikan</label>
                    <textarea name="pendidikan" class="form-control">{{ $pegawai->pendidikan }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="pengalaman_kerja" class="form-label">Pengalaman Kerja</label>
                    <textarea name="pengalaman_kerja" class="form-control">{{ $pegawai->pengalaman_kerja }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="wawancara" class="form-label">Hasil Wawancara</label>
                    <textarea name="wawancara" class="form-control">{{ $pegawai->wawancara }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="sertifikasi_pendukung" class="form-label">Sertifikasi Pendukung</label>
                    <textarea name="sertifikasi_pendukung" class="form-control">{{ $pegawai->sertifikasi_pendukung }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="kemampuan" class="form-label">Kemampuan</label>
                    <textarea name="kemampuan" class="form-control">{{ $pegawai->kemampuan }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="cv" class="form-label">CV (PDF/DOC/DOCX, max 2MB)</label>
                    @if ($pegawai->cv)
                        <p>CV saat ini: <a href="{{ asset('storage/cv/' . $pegawai->cv) }}" target="_blank">{{ $pegawai->cv }}</a></p>
                    @endif
                    <input type="file" name="cv" class="form-control" accept=".pdf,.doc,.docx">
                </div>

                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </form>
        </div>
    </div>
</div>
@endsection

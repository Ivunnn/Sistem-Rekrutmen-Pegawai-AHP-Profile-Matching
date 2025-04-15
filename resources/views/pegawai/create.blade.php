@extends('adminlte::page')

@section('title', 'Manajemen Pegawai')

@section('content_header')
    <h2> Tambah Data Pegawai </h2>
@stop

@section('content')

<form id="employeeCreateForm" action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="pull-right mb-3">
        <a class="btn btn-secondary" href="{{ route('pegawai.index') }}">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

    <div class="row" style="overflow: auto; max-height: 80vh">
        <div class="column">
            <div class="form-group col-md-11">
                <strong>No Peserta:</strong>
                <input type="text" name="no_peserta" class="form-control" placeholder="Contoh: PGW001" required>
            </div>
            <div class="form-group col-md-11">
                <strong>Nama Pegawai:</strong>
                <input type="text" name="name" class="form-control" placeholder="Nama lengkap" required>
            </div>
            <div class="form-group col-md-11">
                <strong>Bagian yang Dilamar:</strong>
                <input type="text" name="bagian_dilamar" class="form-control" placeholder="Contoh: IT Support" required>
            </div>
            <div class="form-group col-md-11">
                <strong>Pendidikan:</strong>
                <input type="text" name="pendidikan" class="form-control" placeholder="Contoh: S1 Teknik Informatika">
            </div>
            <div class="form-group col-md-11">
                <strong>Pengalaman Kerja:</strong>
                <textarea name="pengalaman_kerja" class="form-control" rows="3" placeholder="Contoh: 2 tahun sebagai admin"></textarea>
            </div>
        </div>

        <div class="column">
            <div class="form-group col-md-11">
                <strong>Wawancara:</strong>
                <textarea name="wawancara" class="form-control" rows="3" placeholder="Catatan hasil wawancara"></textarea>
            </div>
            <div class="form-group col-md-11">
                <strong>Sertifikasi Pendukung:</strong>
                <textarea name="sertifikasi_pendukung" class="form-control" rows="3" placeholder="Contoh: Sertifikat Google, TOEFL, dll"></textarea>
            </div>
            <div class="form-group col-md-11">
                <strong>Kemampuan:</strong>
                <textarea name="kemampuan" class="form-control" rows="3" placeholder="Contoh: PHP, Laravel, Public Speaking"></textarea>
            </div>
            <div class="form-group col-md-11">
                <strong>Upload CV (PDF/DOC/DOCX):</strong>
                <input type="file" name="cv" class="form-control">
            </div>
        </div>
    </div>
</form>

@endsection

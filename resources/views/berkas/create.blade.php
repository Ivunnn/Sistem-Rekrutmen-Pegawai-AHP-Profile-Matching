@extends('adminlte::page')

@section('title', 'Tambah Data Berkas')

@section('content_header')
    <h3>Isi Data Berkas</h3>
@endsection

@section('content')
<div class="container">
    <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Bagian yang dilamar</label>
            <select name="bagian" class="form-control" required>
                <option value="sales">Sales</option>
                <option value="digital marketing">Digital Marketing</option>
            </select>
        </div>

        <div class="form-group">
            <label>Pendidikan</label>
            <input type="text" name="pendidikan" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Sertifikat Pendukung</label>
            <input type="text" name="sertifikat_pendukung" class="form-control">
        </div>

        <div class="form-group">
            <label>Upload CV</label>
            <input type="file" name="cv" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection

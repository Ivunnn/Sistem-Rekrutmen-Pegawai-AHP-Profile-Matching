@extends('adminlte::page')

@section('title', 'Manajemen Pegawai')

@section('content_header')
<div class="container-fluid">
    <div class="card-header text-lg">Tambah Pegawai Baru</div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('pegawai.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="bagian_dilamar" class="col-md-4 col-form-label text-md-right">Bagian Yang Dilamar</label>
                            <div class="col-md-6">
                                <input id="bagian_dilamar" type="text" class="form-control @error('bagian_dilamar') is-invalid @enderror" name="bagian_dilamar" value="{{ old('bagian_dilamar') }}" required>
                                @error('bagian_dilamar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="pendidikan" class="col-md-4 col-form-label text-md-right">Pendidikan</label>
                            <div class="col-md-6">
                                <textarea id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan">{{ old('pendidikan') }}</textarea>
                                @error('pendidikan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="pengalaman_kerja" class="col-md-4 col-form-label text-md-right">Pengalaman Kerja</label>
                            <div class="col-md-6">
                                <textarea id="pengalaman_kerja" class="form-control @error('pengalaman_kerja') is-invalid @enderror" name="pengalaman_kerja">{{ old('pengalaman_kerja') }}</textarea>
                                @error('pengalaman_kerja')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="sertifikasi_pendukung" class="col-md-4 col-form-label text-md-right">Sertifikasi Pendukung</label>
                            <div class="col-md-6">
                                <textarea id="sertifikasi_pendukung" class="form-control @error('sertifikasi_pendukung') is-invalid @enderror" name="sertifikasi_pendukung">{{ old('sertifikasi_pendukung') }}</textarea>
                                @error('sertifikasi_pendukung')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="kemampuan" class="col-md-4 col-form-label text-md-right">Kemampuan</label>
                            <div class="col-md-6">
                                <textarea id="kemampuan" class="form-control @error('kemampuan') is-invalid @enderror" name="kemampuan">{{ old('kemampuan') }}</textarea>
                                @error('kemampuan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="cv" class="col-md-4 col-form-label text-md-right">CV (PDF/DOC/DOCX)</label>
                            <div class="col-md-6">
                                <input id="cv" type="file" class="form-control @error('cv') is-invalid @enderror" name="cv" accept=".pdf,.doc,.docx">
                                @error('cv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
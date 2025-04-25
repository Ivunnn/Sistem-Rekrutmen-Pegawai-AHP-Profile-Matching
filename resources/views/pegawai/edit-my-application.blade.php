@extends('adminlte::page')

@section('title', 'Manajemen Pegawai')

@section('content_header')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Data Aplikasi</h5>
                        <a href="{{ route('pegawai.my-application') }}" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('pegawai.update-my-application') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Nama</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                                <small class="form-text text-muted">Nama tidak dapat diubah, sesuai dengan akun Anda</small>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="bagian_dilamar" class="col-md-3 col-form-label text-md-right">Bagian Dilamar *</label>
                            <div class="col-md-9">
                                <select name="bagian_dilamar" id="bagian_dilamar" class="form-control @error('bagian_dilamar') is-invalid @enderror" required>
                                    <option value="">-- Pilih Bagian --</option>
                                    <option value="sales" {{ $pegawai->bagian_dilamar == 'sales' ? 'selected' : '' }}>Sales</option>
                                    <option value="digital marketing" {{ $pegawai->bagian_dilamar == 'digital marketing' ? 'selected' : '' }}>Digital Marketing</option>
                                    <option value="it" {{ $pegawai->bagian_dilamar == 'it' ? 'selected' : '' }}>IT</option>
                                    <option value="admin" {{ $pegawai->bagian_dilamar == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('bagian_dilamar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="pendidikan" class="col-md-3 col-form-label text-md-right">Pendidikan Terakhir</label>
                            <div class="col-md-9">
                                <textarea name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" rows="3">{{ old('pendidikan', $pegawai->pendidikan) }}</textarea>
                                <small class="form-text text-muted">Contoh: S1 Teknik Informatika, Universitas XYZ, 2015-2019</small>
                                @error('pendidikan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="pengalaman_kerja" class="col-md-3 col-form-label text-md-right">Pengalaman Kerja</label>
                            <div class="col-md-9">
                                <textarea name="pengalaman_kerja" id="pengalaman_kerja" class="form-control @error('pengalaman_kerja') is-invalid @enderror" rows="4">{{ old('pengalaman_kerja', $pegawai->pengalaman_kerja) }}</textarea>
                                <small class="form-text text-muted">Isi dengan riwayat pekerjaan Anda</small>
                                @error('pengalaman_kerja')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="sertifikasi_pendukung" class="col-md-3 col-form-label text-md-right">Sertifikasi Pendukung</label>
                            <div class="col-md-9">
                                <textarea name="sertifikasi_pendukung" id="sertifikasi_pendukung" class="form-control @error('sertifikasi_pendukung') is-invalid @enderror" rows="3">{{ old('sertifikasi_pendukung', $pegawai->sertifikasi_pendukung) }}</textarea>
                                <small class="form-text text-muted">Isi dengan sertifikasi yang Anda miliki</small>
                                @error('sertifikasi_pendukung')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="kemampuan" class="col-md-3 col-form-label text-md-right">Kemampuan</label>
                            <div class="col-md-9">
                                <textarea name="kemampuan" id="kemampuan" class="form-control @error('kemampuan') is-invalid @enderror" rows="3">{{ old('kemampuan', $pegawai->kemampuan) }}</textarea>
                                <small class="form-text text-muted">Isi dengan kemampuan atau skill yang Anda miliki</small>
                                @error('kemampuan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="cv" class="col-md-3 col-form-label text-md-right">Upload CV</label>
                            <div class="col-md-9">
                                <input type="file" name="cv" id="cv" class="form-control @error('cv') is-invalid @enderror">
                                <small class="form-text text-muted">Format file: PDF, DOC, DOCX. Max: 2MB</small>
                                @if($pegawai->cv)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/cv/' . $pegawai->cv) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-file-pdf"></i> CV Saat Ini
                                        </a>
                                        <small class="text-muted ml-2">Upload file baru untuk mengganti CV</small>
                                    </div>
                                @endif
                                @error('cv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
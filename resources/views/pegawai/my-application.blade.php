@extends('adminlte::page')

@section('title', 'Manajemen Pegawai')

@section('content_header')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Aplikasi Saya</h5>
                        <a href="{{ route('pegawai.edit-my-application') }}" class="btn btn-primary btn-sm">Edit Aplikasi</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="200">Nama</th>
                                        <td>{{ $pegawai->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bagian Dilamar</th>
                                        <td>{{ $pegawai->bagian_dilamar }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pendidikan</th>
                                        <td>{{ $pegawai->pendidikan ?? 'Belum diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pengalaman Kerja</th>
                                        <td>{{ $pegawai->pengalaman_kerja ?? 'Belum diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sertifikasi Pendukung</th>
                                        <td>{{ $pegawai->sertifikasi_pendukung ?? 'Belum diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kemampuan</th>
                                        <td>{{ $pegawai->kemampuan ?? 'Belum diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <th>CV</th>
                                        <td>
                                            @if($pegawai->cv)
                                                <a href="{{ asset('storage/cv/' . $pegawai->cv) }}" target="_blank" class="btn btn-sm btn-info">
                                                    <i class="fa fa-file-pdf"></i> Lihat CV
                                                </a>
                                            @else
                                                <span class="text-danger">Belum upload CV</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> Silahkan lengkapi data aplikasi Anda untuk proses seleksi.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('adminlte::page')

@section('title', 'Manajemen Pelamar')

@section('content_header')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Pegawai</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama</th>
                                <td>{{ $pegawai->name }}</td>
                            </tr>
                            <tr>
                                <th>Bagian Dilamar</th>
                                <td>{{ $pegawai->bagian_dilamar }}</td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <td>{{ $pegawai->pendidikan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pengalaman Kerja</th>
                                <td>{{ $pegawai->pengalaman_kerja ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Sertifikasi Pendukung</th>
                                <td>{{ $pegawai->sertifikasi_pendukung ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Kemampuan</th>
                                <td>{{ $pegawai->kemampuan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>CV</th>
                                <td>
                                    @if($pegawai->cv)
                                        <a href="{{ asset('storage/cv/' . $pegawai->cv) }}" target="_blank" class="btn btn-sm btn-info">Lihat CV</a>
                                    @else
                                        Tidak ada CV
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
                        <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('adminlte::page')

@section('title', 'Manajemen Nilai Aktual')

@section('content_header')
    <h3>Daftar Pegawai untuk Input Nilai Aktual</h3>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Bagian Dilamar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pegawais as $pegawai)
                            <tr>
                                <td>{{ $pegawai->name }}</td>
                                <td>{{ $pegawai->bagian_dilamar }}</td>
                                <td><a href="{{ route('nilai-aktual.edit', $pegawai->id) }}"
                                        class="btn btn-sm btn-primary">Input
                                        Nilai</a>
                                    <a href="{{ route('nilai-aktual.show', $pegawai->id) }}" class="btn btn-sm btn-info">Lihat
                                        Nilai</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@extends('adminlte::page')

@section('title', 'Manajemen Pegawai')

@section('content_header')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Daftar Pegawai</h2>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-md">Tambah Pegawai</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Bagian Dilamar</th>
                                        <th>Pendidikan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pegawais as $index => $pegawai)
                                        <tr>
                                            <td>{{ $index + $pegawais->firstItem() }}</td>
                                            <td>{{ $pegawai->name }}</td>
                                            <td>{{ $pegawai->bagian_dilamar }}</td>
                                            <td>{{ $pegawai->pendidikan ?? '-' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('pegawai.show', $pegawai->id) }}"
                                                        class="btn btn-info btn-sm mx-1">Detail</a>
                                                    <a href="{{ route('pegawai.edit', $pegawai->id) }}"
                                                        class="btn btn-warning btn-sm mx-1">Edit</a>
                                                    <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mx-1">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data pegawai</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $pegawais->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
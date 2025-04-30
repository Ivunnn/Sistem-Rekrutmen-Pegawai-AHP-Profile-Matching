@extends('adminlte::page')

@section('title', 'Manajemen Nilai Ideal')

@section('content_header')
    <div class="container-fluid">
        <h4 class="mb-3">Manajemen Nilai Ideal</h4>

        <a href="{{ route('nilai-ideal.create') }}" class="btn btn-primary mb-3">Tambah Nilai Ideal</a>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Nilai Ideal</th>
                        <th>Tipe Faktor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiIdeals as $nilai)
                        <tr>
                            <td>{{ $nilai->kriteria->nama }}</td>
                            <td>{{ $nilai->nilai_ideal }}</td>
                            <td>{{ ucfirst($nilai->tipe_faktor) }}</td>
                            <td>
                                <a href="{{ route('nilai-ideal.edit', $nilai->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('nilai-ideal.destroy', $nilai->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
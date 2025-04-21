@extends('adminlte::page')

@section('title', 'Manajemen Kriteria')

@section('content_header')
<h2> Manajemen Kriteria </h2>
@stop

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex flex-column justify-content-between align-items-start">
            @if($kriterias->count() < 5)
                <a href="{{ route('kriteria.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Kriteria
                </a>
            @endif
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Kriteria</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriterias as $kriteria)
                        <tr>
                            <td>{{ $kriteria->nama }}</td>
                            <td>
                                <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($kriterias->isEmpty())
                        <tr><td colspan="3" class="text-center">Belum ada kriteria</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

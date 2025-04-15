@extends('adminlte::page')

@section('title', 'Manajemen Pegawai')

@section('content_header')
    <h2>Manajemen Pegawai</h2>
@stop

@section('content')

<p>Halo {{ auth()->user()->name }}, di laman ini Anda bisa mengatur data pegawai.</p>

@include('partials.alert')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Daftar Pegawai</h4>
    <a class="btn btn-success" href="{{ route('pegawai.create') }}">
        <i class="fas fa-plus"></i> Tambah Pegawai
    </a>
</div>

<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th style="text-align: center">No</th>
            <th>No Peserta</th>
            <th>Nama</th>
            <th>Bagian</th>
            <th>Pendidikan</th>
            <th width="220px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pegawais as $key => $pegawai)
        <tr>
            <td style="text-align: center">{{ $key + 1 }}</td>
            <td>{{ $pegawai->no_peserta }}</td>
            <td>{{ $pegawai->name }}</td>
            <td>{{ $pegawai->bagian_dilamar }}</td>
            <td>{{ $pegawai->pendidikan }}</td>
            <td>
                <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST">
                    <a class="btn btn-info btn-sm" href="{{ route('pegawai.show', $pegawai->id) }}">Detail</a>
                    @can('pegawai-edit')
                    <a class="btn btn-primary btn-sm" href="{{ route('pegawai.edit', $pegawai->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin ingin menghapus pegawai ini?')">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
<div class="d-flex justify-content-end mt-3">
    {!! $pegawais->links() !!}
</div>

@endsection

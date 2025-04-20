@extends('adminlte::page')

@section('title', 'Manajemen Kriteria')

@section('content_header')
<h2> Manajemen Kriteria </h2>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Kriteria</h3>
        </div>
        <form action="{{ route('kriteria.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Kriteria</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

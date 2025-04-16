@extends('adminlte::page')

@section('title', 'Manajemen Kriteria')

@section('content_header')
<h2> Manajemen Kriteria </h2>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Kriteria</h3>
        </div>
        <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
            @csrf 
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Kriteria</label>
                    <input type="text" name="nama" value="{{ $kriteria->nama }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="bobot">Bobot (0 - 1)</label>
                    <input type="number" step="0.01" name="bobot" value="{{ $kriteria->bobot }}" class="form-control" required>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-warning">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection

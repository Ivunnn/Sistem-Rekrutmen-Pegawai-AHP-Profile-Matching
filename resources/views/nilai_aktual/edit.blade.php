@extends('adminlte::page')

@section('title', 'Manajemen Nilai Aktual')

@section('content_header')
<h3>Edit Nilai Aktual - {{ $pegawai->name }}</h3>

<form method="POST" action="{{ route('nilai-aktual.update', $pegawai->id) }}">
    @csrf
    @foreach($kriterias as $kriteria)
        <div class="form-group">
            <label>{{ $kriteria->nama }}</label>
            <input type="number" step="0.1" name="kriteria[{{ $kriteria->id }}]" class="form-control"
                value="{{ $nilai_aktual[$kriteria->id] ?? '' }}" required>
        </div>
    @endforeach
    <a href="{{ route('nilai-aktual.index') }}" class="btn btn-secondary">
        Kembali
    </a>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection


@extends('adminlte::page')

@section('title', 'Manajemen Nilai Ideal')

@section('content_header')
<div class="container-fluid">
    <h4 class="mb-3">Edit Nilai Ideal</h4>

    <form action="{{ route('nilai-ideal.update', $nilaiIdeal->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>{{ $nilaiIdeal->kriteria->nama }}</label>
            <input type="number" class="form-control" name="nilai_ideal" value="{{ $nilaiIdeal->nilai_ideal }}" step="0.01" required>
            <select class="form-control mt-2" name="tipe_faktor">
                <option value="core" {{ $nilaiIdeal->tipe_faktor == 'core' ? 'selected' : '' }}>Core</option>
                <option value="secondary" {{ $nilaiIdeal->tipe_faktor == 'secondary' ? 'selected' : '' }}>Secondary</option>
            </select>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

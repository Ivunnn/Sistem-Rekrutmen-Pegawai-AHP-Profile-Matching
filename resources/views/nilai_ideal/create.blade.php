@extends('adminlte::page')

@section('title', 'Manajemen Nilai Ideal')

@section('content_header')
<div class="container-fluid">
    <h4 class="mb-3">Tambah Nilai Ideal</h4>

    <form action="{{ route('nilai-ideal.store') }}" method="POST">
        @csrf
        @foreach ($kriterias as $kriteria)
            <div class="mb-3">
                <label>{{ $kriteria->nama }}</label>
                <input type="hidden" name="nilai_ideal[{{ $loop->index }}][kriteria_id]" value="{{ $kriteria->id }}">
                <input type="number" class="form-control" step="0.01" name="nilai_ideal[{{ $loop->index }}][nilai_ideal]" required>
                <select class="form-control mt-2" name="nilai_ideal[{{ $loop->index }}][tipe_faktor]">
                    <option value="core">Core Factor (CF)</option>
                    <option value="secondary">Secondary Factor (SF)</option>
                </select>
            </div>
        @endforeach
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection

@extends('adminlte::page')

@section('title', 'Hasil AHP')

@section('content_header')
    <h2>Hasil Perhitungan AHP</h2>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        @if ($result['consistent'])
            <div class="alert alert-success">
                Matriks konsisten ✅ (CR = {{ number_format($result['cr'], 4) }})
            </div>
        @else
            <div class="alert alert-danger">
                Matriks tidak konsisten ❌ (CR = {{ number_format($result['cr'], 4) }})
            </div>
        @endif
        <table class="table table-bordered mt-3">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Kriteria</th>
                    <th>Bobot Awal</th>
                    <th>Bobot Terhitung (AHP)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kriteria as $index => $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ number_format($item->bobot, 4) }}</td>
                    <td>{{ number_format($result['weights'][$index], 4) }}</td>
                </tr>
                @endforeach
                <form action="{{ route('ahp.saveAHPResult') }}" method="POST">
                    @csrf
                    @foreach ($kriteria as $index => $item)
                        <input type="hidden" name="bobot[{{ $item->id }}]" value="{{ $result['weights'][$index] }}">
                    @endforeach
                    <button type="submit" class="btn btn-success mt-3">
                        <i class="fas fa-save"></i> Simpan Bobot AHP ke Database
                    </button>
                </form>                
            </tbody>
        </table>
        

        <a href="{{ route('ahp.index') }}" class="btn btn-primary mt-3">Kembali ke Halaman AHP</a>
    </div>
</div>

@endsection

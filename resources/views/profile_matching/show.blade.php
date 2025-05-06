@extends('adminlte::page')

@section('title', 'Detail Profile Matching')

@section('content_header')
<h1>Detail Perhitungan Profile Matching</h1>
<p>Nama Pegawai: {{ $pegawai->name }} - Posisi: {{ $pegawai->bagian_dilamar }}</p>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail GAP dan Pembobotan</h3>
        <div class="card-tools">
            <a href="{{ route('profile-matching.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    <th>Nilai Ideal</th>
                    <th>Nilai Aktual</th>
                    <th>GAP</th>
                    <th>Bobot GAP</th>
                    <th>Tipe Faktor</th>
                    <th>Bobot AHP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profileMatching->hasil_perhitungan as $kriteriaId => $hasil)
                    <tr>
                        <td>{{ $hasil['kriteria_nama'] }}</td>
                        <td>{{ $hasil['nilai_ideal'] }}</td>
                        <td>{{ $hasil['nilai_aktual'] }}</td>
                        <td>{{ $hasil['gap'] }}</td>
                        <td>{{ $hasil['bobot_gap'] }}</td>
                        <td>
                            @if($hasil['tipe_faktor'] == 'core')
                                <span class="badge badge-primary">Core Factor</span>
                            @else
                                <span class="badge badge-secondary">Secondary Factor</span>
                            @endif
                        </td>
                        <td>{{ number_format($kriterias->firstWhere('id', $kriteriaId)->bobot, 3) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Perhitungan Nilai</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Nilai Core Factor (CF)</th>
                        <td>{{ number_format($profileMatching->nilai_cf, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Secondary Factor (SF)</th>
                        <td>{{ number_format($profileMatching->nilai_sf, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Total (60% CF + 40% SF)</th>
                        <td>{{ number_format($profileMatching->nilai_total, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Akhir (dengan Bobot AHP)</th>
                        <td>{{ number_format($profileMatching->nilai_akhir, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Peringkat</th>
                        <td>{{ $profileMatching->ranking }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Keterangan Bobot GAP</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Selisih</th>
                            <th>Bobot</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\GapBobot::all() as $gap)
                            <tr>
                                <td>{{ $gap->selisih }}</td>
                                <td>{{ $gap->bobot }}</td>
                                <td>{{ $gap->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Detail Perhitungan AHP</h5>
                        <div>
                            <a href="{{ route('user.bobot.ahp.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            @if(Auth::user()->id == $ahp->creator_id || Auth::user()->hasRole('Admin'))
                            <a href="{{ route('user.bobot.ahp.edit', $ahp->id_perhitungan) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('user.bobot.ahp.destroy', $ahp->id_perhitungan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus perhitungan ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Informasi Perhitungan</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Nama Perhitungan</th>
                                            <td>{{ $ahp->nama_perhitungan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Detail</th>
                                            <td>{{ $ahp->detail }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Konsistensi</th>
                                            <td>
                                                @if($ahp->is_konsisten)
                                                    <span class="badge bg-success">Konsisten</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Konsisten</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dibuat Oleh</th>
                                            <td>
                                                @if($ahp->is_created_by_admin)
                                                    <span class="badge bg-info">Admin</span>
                                                @else
                                                    {{ $ahp->creator_id }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Dibuat</th>
                                            <td>{{ $ahp->created_at }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">Hasil Perhitungan</h5>
                                </div>
                                <div class="card-body">
                                    @if($bobot)
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Lambda Max</th>
                                            <td>{{ number_format($bobot->lamda_max, 4) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Consistency Index (CI)</th>
                                            <td>{{ number_format($bobot->consistency_index, 4) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Consistency Ratio (CR)</th>
                                            <td>
                                                {{ number_format($bobot->consistency_ratio, 4) }}
                                                @if($bobot->consistency_ratio < 0.1)
                                                    <span class="badge bg-success">Konsisten</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Konsisten</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                    @else
                                    <div class="alert alert-warning">
                                        Data bobot tidak tersedia untuk perhitungan ini.
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($bobot)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0">Bobot Kriteria</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th class="text-center">C1</th>
                                                    <th class="text-center">C2</th>
                                                    <th class="text-center">C3</th>
                                                    <th class="text-center">C4</th>
                                                    <th class="text-center">C5</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">{{ number_format($bobot->c1, 4) }}</td>
                                                    <td class="text-center">{{ number_format($bobot->c2, 4) }}</td>
                                                    <td class="text-center">{{ number_format($bobot->c3, 4) }}</td>
                                                    <td class="text-center">{{ number_format($bobot->c4, 4) }}</td>
                                                    <td class="text-center">{{ number_format($bobot->c5, 4) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <canvas id="bobotChart" width="400" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if(count($PB_obj) > 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0">Matriks Perbandingan Berpasangan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th class="text-center">Kriteria</th>
                                                    <th class="text-center">C1</th>
                                                    <th class="text-center">C2</th>
                                                    <th class="text-center">C3</th>
                                                    <th class="text-center">C4</th>
                                                    <th class="text-center">C5</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($PB_obj as $pb)
                                                <tr>
                                                    <th class="text-center bg-light">{{ $pb->nama_kriteria }}</th>
                                                    <td class="text-center {{ $pb->nama_kriteria == 'C1' ? 'table-secondary' : '' }}">
                                                        {{ number_format($pb->c1, 2) }}
                                                    </td>
                                                    <td class="text-center {{ $pb->nama_kriteria == 'C2' ? 'table-secondary' : '' }}">
                                                        {{ number_format($pb->c2, 2) }}
                                                    </td>
                                                    <td class="text-center {{ $pb->nama_kriteria == 'C3' ? 'table-secondary' : '' }}">
                                                        {{ number_format($pb->c3, 2) }}
                                                    </td>
                                                    <td class="text-center {{ $pb->nama_kriteria == 'C4' ? 'table-secondary' : '' }}">
                                                        {{ number_format($pb->c4, 2) }}
                                                    </td>
                                                    <td class="text-center {{ $pb->nama_kriteria == 'C5' ? 'table-secondary' : '' }}">
                                                        {{ number_format($pb->c5, 2) }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Penjelasan AHP -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-dark text-white">
                                    <h5 class="mb-0">Penjelasan Perhitungan AHP</h5>
                                </div>
                                <div class="card-body">
                                    <div class="accordion" id="ahpExplanation">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    Apa itu AHP?
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#ahpExplanation">
                                                <div class="accordion-body">
                                                    <p>Analytic Hierarchy Process (AHP) adalah teknik pengambilan keputusan multi-kriteria yang dikembangkan oleh Thomas L. Saaty pada tahun 1970-an. Metode ini memungkinkan pengambil keputusan untuk memodelkan masalah yang kompleks dalam struktur hierarkis yang menunjukkan hubungan antara tujuan, kriteria, sub-kriteria, dan alternatif.</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Bagaimana Cara Kerja AHP?
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#ahpExplanation">
                                                <div class="accordion-body">
                                                    <p>AHP menggunakan perbandingan berpasangan untuk menentukan bobot relatif antar kriteria. Langkah-langkah dasarnya adalah:</p>
                                                    <ol>
                                                        <li>Mendefinisikan masalah dan menentukan kriteria</li>
                                                        <li>Membuat matriks perbandingan berpasangan</li>
                                                        <li>Menghitung bobot prioritas</li>
                                                        <li>Memeriksa konsistensi (Consistency Ratio)</li>
                                                        <li>Mengevaluasi alternatif berdasarkan bobot</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Konsistensi dalam AHP
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#ahpExplanation">
                                                <div class="accordion-body">
                                                    <p>Konsistensi dalam AHP diukur dengan Consistency Ratio (CR). Ketika CR < 0.1, perbandingan dianggap konsisten. Jika CR ≥ 0.1, maka perbandingan perlu ditinjau kembali.</p>
                                                    <p>Rumus untuk menghitung CR adalah:</p>
                                                    <ul>
                                                        <li>CR = CI / RI</li>
                                                        <li>CI = (λmax - n) / (n - 1)</li>
                                                    </ul>
                                                    <p>Dimana:</p>
                                                    <ul>
                                                        <li>CR = Consistency Ratio</li>
                                                        <li>CI = Consistency Index</li>
                                                        <li>RI = Random Index (nilai tetap berdasarkan jumlah kriteria)</li>
                                                        <li>λmax = Nilai eigen maksimum dari matriks perbandingan</li>
                                                        <li>n = Jumlah kriteria</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if($bobot)
        const ctx = document.getElementById('bobotChart').getContext('2d');
        
        // Prepare data for chart
        const labels = ['C1', 'C2', 'C3', 'C4', 'C5'];
        const data = [
            {{ $bobot->c1 }},
            {{ $bobot->c2 }},
            {{ $bobot->c3 }},
            {{ $bobot->c4 }},
            {{ $bobot->c5 }}
        ];
        
        const backgroundColors = [
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 99, 132, 0.5)',
            'rgba(255, 206, 86, 0.5)',
            'rgba(75, 192, 192, 0.5)',
            'rgba(153, 102, 255, 0.5)'
        ];
        
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Bobot Kriteria',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(color => color.replace('0.5', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: Math.max(...data) * 1.2
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Bobot: ${context.raw.toFixed(4)}`;
                            }
                        }
                    }
                }
            }
        });
        @endif
    });
</script>
@endsection
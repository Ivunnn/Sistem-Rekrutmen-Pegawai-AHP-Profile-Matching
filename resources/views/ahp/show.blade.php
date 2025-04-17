@extends('adminlte::page')

@section('title', 'View AHP Calculation')

@section('content_header')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Detail Perhitungan AHP</h1>
  </div>
  <div class="col-sm-6">
    <a class="btn btn-secondary float-right" href="{{ route('ahp.index') }}">Kembali</a>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Information Dasar</h3>
        </div>
        <div class="card-body">
          <table class="table">
            <tr>
              <th style="width: 30%">Nama</th>
              <td>{{ $calculation->nama }}</td>
            </tr>
            <tr>
              <th>Detail</th>
              <td>{{ $calculation->detail }}</td>
            </tr>
            <tr>
              <th>Consistency Ratio</th>
              <td>
                {{ number_format($calculation->consistency_ratio, 4) }}
                @if ($calculation->consistency_ratio < 0.1)
                <span class="badge badge-success">Consistent</span>
                @else
                <span class="badge badge-danger">Inconsistent</span>
                @endif
              </td>
            </tr>
            <tr>
              <th>Dibuat Oleh</th>
              <td>{{ $calculation->user->name }}</td>
            </tr>
            <tr>
              <th>Dibuat Pada</th>
              <td>{{ $calculation->created_at->format('d M Y H:i') }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Bobot Kriteria</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
              </tr>
            </thead>
            <tbody>
              @foreach($kriterias as $index => $kriteria)
              <tr>
                <td>C{{ $index + 1 }}</td>
                <td>{{ $kriteria->nama }}</td>
                <td>{{ number_format($kriteria->bobot, 4) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        
        <div class="card-footer">
          <div id="weightChart" style="height: 300px;"></div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pairwise Comparison Matrix</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Criteria</th>
                @foreach($kriterias as $index => $kriteria)
                <th>C{{ $index + 1 }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($kriterias as $i => $rowKriteria)
              <tr>
                <td><strong>C{{ $i + 1 }}</strong></td>
                @foreach($kriterias as $j => $colKriteria)
                <td>{{ number_format($matrixData[$i][$j], 2) }}</td>
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const criteria = [
      @foreach($kriterias as $index => $kriteria)
      "{{ $kriteria->nama }} (C{{ $index + 1 }})",
      @endforeach
    ];
    
    const weights = [
      @foreach($kriterias as $kriteria)
      {{ $kriteria->bobot }},
      @endforeach
    ];
    
    const options = {
      series: [{
        name: 'Weight',
        data: weights
      }],
      chart: {
        type: 'bar',
        height: 300
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '50%',
        },
      },
      dataLabels: {
        enabled: true,
        formatter: function(val) {
          return val.toFixed(4);
        }
      },
      xaxis: {
        categories: criteria,
        labels: {
          rotate: -45,
          style: {
            fontSize: '12px'
          }
        }
      },
      title: {
        text: 'Criteria Weights Distribution',
        align: 'center'
      },
      colors: ['#6c7ae0']
    };
    
    const chart = new ApexCharts(document.querySelector("#weightChart"), options);
    chart.render();
  });
</script>
@stop
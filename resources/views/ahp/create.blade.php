@extends('adminlte::page')

@section('title', 'AHP Management')

@section('content_header')
<h2> Add New AHP Calculation </h2>

<form id="productCreateForm" action="{{ route('ahp.store') }}" method="POST">
  @csrf

  <div class="pull-right">
    <a class="btn btn-secondary" href="{{ route('ahp.index') }}"> Back</a>
    <noscript>
      <input type="submit" value="Submit form!" />
    </noscript>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  @stop

  @section('content')

    <style>
    * {
      box-sizing: border-box;
    }

    th {
      position: relative;
      top: 0;
      background: #6c7ae0;
      text-align: Center;
      font-weight: normal;
      font-size: 1.1rem;
      color: white;
    }

    input {
      text-align: center;
    }

    .custColor {
      top: 0;
      background: #6c7ae0;
      text-align: Center;
      font-weight: normal;
      font-size: 1.1rem;
      color: white;
    }

    .cssTableCenter td {
      text-align: center;
      vertical-align: middle;
    }

    .goCenter {
      text-align: center;
      vertical-align: middle;
    }

    .column {
      float: left;
      width: 50%;
    }

    select {
      width: 400px;
      text-align-last: center;
      text-align: center;
    }
    </style>

    <div class="content">
    <div class="container-fluid">
      @include('partials.alert')
      @yield('content')
    </div><!-- /.container-fluid -->
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row">
    <div class="col-md-4">
      <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Daftar kriteria</h3>
        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
          title="Collapse">
          <i class="fas fa-minus"></i></button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover table-borderless table-striped">
        <thead>
          <tr>
          <th class="goCenter">No</th>
          <th class="" style="text-align: left">Kriteria</th>
          <th>Bobot Hasil</th>
          </tr>
        </thead>
        <tbody>
          @foreach($kriterias as $index => $kriteria)
        <tr>
        <td class="custColor goCenter">C{{ $index + 1 }}</td>
        <td><label>{{ $kriteria->nama }}</label></strong></td>
        <td><input type="number" name="bobot_{{ $kriteria->id }}" id="bobot_{{ $kriteria->id }}"
        value="{{ old('bobot_' . $kriteria->id, $kriteria->bobot) }}" readonly></td>
        </tr>
      @endforeach
        </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <div class="card card-info collapsed-card">
      <div class="card-header">
        <h3 class="card-title">Penyebab tidak konsitennya pembobotan </h3>
        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
          title="Collapse">
          <i class="fas fa-plus"></i></button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover table-borderless table-striped">
        <tbody>
          <tr>
          <td class="" colspan="2" style="border-color: #a9d5de;background-color: #f8ffff; text-align: justify;">
            Misalnya Anda memasukkan nilai dengan kepentingan sebagai berikut. <br>
            - Kriteria C1 : 2 kali lebih penting C2 <br>
            - Kriteria C1 : 3 kali lebih penting C3 <br>
            - Kriteria C3 : 9 kali lebih penting C2 <br>
            Maka pembobotan tidak konsisten karena C3 lebih penting dibanding C2, sedangkan dalam perbandingan C1
            dengan C2 dan C3, C2 lebih penting dibanding C3.
            <strong> Ketidak konsistenan tersebut akan menaikkan nilai Consistency Ratio (CR). </strong> Hasil
            bobot perbandingan berpasangan antar kriteria dianggap tidak konsisten apabila nilai CR >= 0,1
          </td>
          </tr>

        </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      </div>
      <!-- /.card -->


    </div>

    <div class="col-md-8">

      <div class="card card-primary">

      <div class="card-header">
        <h3 class="card-title">Detail Perhitungan</h3>

        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
          title="Collapse">
          <i class="fas fa-minus"></i></button>
        </div>
      </div>

      <div class="card-body p-0">

        <table class="table table-hover table-">
        <thead>
          <tr>
          {{-- <th class="goCenter">Intensitas kepentingan</th>
          <th class="goCenter">Definisi</th> --}}
          {{-- <th></th> --}}
          </tr>
        </thead>
        <tbody>
          <tr>
          <td class=""> <strong> Nama Perhitungan </strong></td>
          <td style="width: 70%"> <input type="text" name="nama_perhitungan" class="form-control"
            placeholder="Nama Perhitungan" required style="text-align: left" value="{{ old('nama_perhitungan') }}"> </td>
          </tr>
          <tr>
          <td class=""> <strong> Detail </strong></td>
          <td> <input type="text" name="detail" class="form-control" placeholder="Deskripsi" required
            style="text-align: left" value="{{ old('detail') }}"> </td>
          </tr>
        </tbody>
        </table>
      </div>
      </div>

      <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Tabel Acuan Skala Perbandingan Kriteria</h3>

        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
          title="Collapse">
          <i class="fas fa-minus"></i></button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-hover table-stripe table-borderles">
        <thead>
          <tr>
          <th class="goCenter">Intensitas kepentingan</th>
          <th class="goCente">Definisi</th>
          {{-- <th></th> --}}
          </tr>
        </thead>
        <tbody>

          <tr>
          <td class="goCenter"><strong> 1</strong></td>
          <td>Kedua kriteria tersebut sama pentingnya.</td>
          </tr>
          <tr>
          <td class="goCenter"><strong> 3</strong></td>
          <td>Satu kriteria sedikit lebih penting.</td>
          </tr>
          <tr>
          <td class="goCenter"><strong>5</strong></td>
          <td>Satu kriteria lebih penting.</td>
          </tr>
          <tr>
          <td class="goCenter"><strong>7</strong></td>
          <td>Satu kriteria jauh lebih penting.</td>
          </tr>
          <tr>
          <td class="goCenter"><strong>9</strong></td>
          <td>Satu kriteria sangatlah penting.</td>
          </tr>
          <tr>
          <td class="goCenter"><strong>2, 4, 6, 8</strong></td>
          <td>Nilai antara dua penilaian yang berdekatan.</td>
          </tr>
          <tr>
          <td class="goCenter"><strong>Timbal-balik</strong></td>
          <td>Jika kriteria i ditetapkan dengan salah satu nilai di atas jika dibandingkan dengan kriteria j, maka
            kriteria j memiliki nilai timbal balik jika dibandingkan dengan kriteria i. (Contoh: i : j = 3 maka j
            : i = 1 / 3)</td>
          </tr>
          <tr>
          <td class="" colspan="2" style="border-color: #a9d5de;background-color: #f8ffff; text-align:justify">
            <strong> Catatan cara melakukan perbandingan berpasangan: </strong>
            Perbandingan dibaca dari kriteria baris terhadap kriteria kolom.
            Misalnya kriteria C1 empat kali lebih penting terhadap kriteria C2 maka diisi nilai 4 pada baris C1
            kolom C2 pada Tabel Perbandingan Berpasangan di bawah ini.
          </td>
          </tr>
        </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>


    </div>

    <section class="content">
    <div class="card card-primary">

      <div class="card-header">
      <h3 class="card-title">Tabel Perbandingan Berpasangan &nbsp; &nbsp;</h3>
      <p onclick="resetTabel()" class="btn btn-sm btn-warning">Reset Tabel</p>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      </div>
      </div>

      <div class="card-body p-0">
      <table class="table table-borderless table-sm table-hover cssTableCenter">
        <tr>
        <th>Kriteria</th>
        @foreach($kriterias as $index => $kriteria)
        <th>C{{ $index + 1 }}</th>
        @endforeach
        </tr>

        <datalist id="bobot">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="0.5">1/2</option>
        <option value="0.33">1/3</option>
        <option value="0.25">1/4</option>
        <option value="0.20">1/5</option>
        <option value="0.17">1/6</option>
        <option value="0.14">1/7</option>
        <option value="0.13">1/8</option>
        <option value="0.11">1/9</option>
        <option value="0.67">2/3</option>
        <option value="0.5">2/4</option>
        <option value="0.4">2/5</option>
        <option value="0.33">2/6</option>
        <option value="0.29">2/7</option>
        <option value="0.25">2/8</option>
        <option value="0.22">2/9</option>
        <option value="0.75">3/4</option>
        <option value="0.6">3/5</option>
        <option value="0.5">3/6</option>
        <option value="0.43">3/7</option>
        <option value="0.38">3/8</option>
        <option value="0.33">3/9</option>
        <option value="0.8">4/5</option>
        <option value="0.67">4/6</option>
        <option value="0.57">4/7</option>
        <option value="0.5">4/8</option>
        <option value="0.44">4/9</option>
        <option value="0.83">5/6</option>
        <option value="0.71">5/7</option>
        <option value="0.63">5/8</option>
        <option value="0.56">5/9</option>
        <option value="0.86">6/7</option>
        <option value="0.75">6/8</option>
        <option value="0.67">6/9</option>
        <option value="0.88">7/8</option>
        <option value="0.78">7/9</option>
        <option value="0.89">8/9</option>
        </datalist>

        @php
        $sharedOptions = [
        ['', '.....'],
        [1, '1'],
        [2, '2'],
        [3, '3'],
        [4, '4'],
        [5, '5'],
        [6, '6'],
        [7, '7'],
        [8, '8'],
        [9, '9'],
        [0.5, '1/2'],
        [0.33, '1/3'],
        [0.25, '1/4'],
        [0.20, '1/5'],
        [0.17, '1/6'],
        [0.14, '1/7'],
        [0.13, '1/8'],
        [0.11, '1/9']
        ];
        @endphp

        @foreach($kriterias as $i => $rowKriteria)
        <tr>
          <td class="custColor">C{{ $i + 1 }}</td>
          @foreach($kriterias as $j => $colKriteria)
            @if($i == $j)
              <td><input type="text" name="c{{ $i + 1 }}c{{ $j + 1 }}" class="form-control center" style="text-align:center" value="1" disabled>
              <input type="hidden" name="c{{ $i + 1 }}c{{ $j + 1 }}" value="1">
              </td>
            @elseif($i < $j)
              <td>
                <select name="c{{ $i + 1 }}c{{ $j + 1 }}" id="c{{ $i + 1 }}c{{ $j + 1 }}" class="form-control comparison-select" data-inverse="c{{ $j + 1 }}c{{ $i + 1 }}" required>
                  @foreach ($sharedOptions as $item)
                    <option value="{{ $item[0] }}" 
                      @if ($item[0] === '') disabled selected @endif>
                      {{ $item[1] }}
                    </option>
                  @endforeach
                </select>
              </td>
            @else
              <td><input name="c{{ $i + 1 }}c{{ $j + 1 }}" id="c{{ $i + 1 }}c{{ $j + 1 }}" type="text" class="form-control inverse-value" data-source="c{{ $j + 1 }}c{{ $i + 1 }}" value="" readonly></td>
            @endif
          @endforeach
        </tr>
        @endforeach
      </table>
      </div>
    </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Set up event listeners for all comparison selects
      const comparisonSelects = document.querySelectorAll('.comparison-select');
      
      comparisonSelects.forEach(select => {
        select.addEventListener('change', function() {
          updateInverseValue(this);
        });
        
        // Initialize inverse values on page load
        if (select.value) {
          updateInverseValue(select);
        }
      });
      
      function updateInverseValue(selectElement) {
        const inverseId = selectElement.getAttribute('data-inverse');
        const inverseElement = document.getElementById(inverseId);
        
        if (inverseElement && selectElement.value) {
          const value = parseFloat(selectElement.value);
          if (!isNaN(value) && value !== 0) {
            const inverseValue = 1 / value;
            inverseElement.value = inverseValue.toFixed(2);
          } else {
            inverseElement.value = '';
          }
        }
      }
    });

    function resetTabel() {
      const selects = document.querySelectorAll('.comparison-select');
      selects.forEach(select => {
        select.selectedIndex = 0; // Reset to first option (usually empty)
        
        // Trigger change event to update inverse values
        const event = new Event('change');
        select.dispatchEvent(event);
      });
    }
    </script>
  </form>
@endsection
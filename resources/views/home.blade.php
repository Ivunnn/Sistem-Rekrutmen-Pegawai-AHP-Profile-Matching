@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="text-center">
    <h2>Sistem Pendukung Keputusan</h2>
    <h4>Pemilihan Laptop Menggunakan Metode AHP dan Profile Matching</h4>
</div>
@stop

@section('content')
<div class="container-fluid">
    @include('partials.alert')

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card card-info ">
                <div class="card-header">
                    <h1 class="card-title text-center w-100">Deskripsi</h1>
                </div>
                <div class="card-body">
                    <p style="text-align: justify; font-size: 18px">
                        Banyaknya variasi kualifikasi dan kompetensi calon pegawai di pasar tenaga kerja menyebabkan
                        kesulitan bagi perusahaan dalam menentukan kandidat yang paling sesuai dengan kebutuhan organisasi. 
                        Dalam proses seleksi, terdapat nilai kriteria objektif dari calon pegawai (seperti pengalaman, pendidikan, 
                        atau kemampuan) serta nilai kriteria preferensi dari perusahaan sebagai pembuat keputusan (seperti 
                        kesesuaian budaya kerja atau potensi pengembangan).
                        <br><br>
                        Oleh karena itu, diperlukan <strong>Sistem Pendukung Keputusan (SPK)</strong> untuk membantu perusahaan 
                        mengevaluasi dan memilih kandidat terbaik dengan mempertimbangkan nilai objektif calon pegawai dan 
                        preferensi subjektif perusahaan. 
                        <br><br>
                        Pada sistem ini, metode <strong>AHP</strong> digunakan untuk menghitung bobot relatif antar kriteria, 
                        sedangkan <strong>Profile Matching</strong> digunakan untuk mencocokkan profil kandidat dengan 
                        kriteria ideal, menghasilkan peringkat kandidat berdasarkan kesesuaian.
                    </p>

                    <hr>

                    <div class="text-center mb-4">
                        <h5 style="font-size: 18px">
                            Alur penggunaan sistem:
                            <br>
                            <i class="fas fa-arrow-right"></i> Input Kriteria pada menu Manajemen Kriteria
                            <i class="fas fa-arrow-right"></i> Pembobotan nilai Kriteria pada menu Pembobotan AHP
                            <i class="fas fa-arrow-right"></i> Input Nilai Ideal Kriteria pada menu Nilai Ideal
                            <i class="fas fa-arrow-right"></i> Input Nilai Aktual Kriteria pada menu Nilai Aktual
                            <i class="fas fa-arrow-right"></i> Hasil Pemeringkatan menggunakan perhitungan Profile Matching pada menu Profile Matching
                        </h5>
                    </div>

                    <div class="text-center">
                        <a class="btn btn-info btn-lg" href="{{ route('kriteria.index') }}">Mulai!</a>
                    </div>
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
<script> console.log('Hi!'); </script>
@stop

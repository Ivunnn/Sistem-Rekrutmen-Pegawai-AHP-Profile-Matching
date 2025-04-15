<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PT Mutiara Putri Gemilang</title>

  {{--
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}"> --}}
  <!-- Favicons -->
  <link href="{{ asset('landingpage/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('landingpage/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  {{-- Leaflet Maps --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />


  <!-- Vendor CSS Files -->
  <link href="{{ asset('landingpage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('landingpage/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
    * Template Name: Bell - v2.2.0
    * Template URL: https://bootstrapmade.com/bell-free-bootstrap-4-template/
    * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Hero Section ======= -->
  <section class="hero">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          <img alt="Bell Logo" src="{{ asset('landingpage/assets/img/logo-ptmpg-putih.png') }}" width="400">
        </div>
      </div>
      <div class="my-4">
        <h2>
          <b>Selamat Datang di PT Mutiara Putri Gemilang
        </h2>
        <a class="btn btn-primary scrollto" href="{{ route('home') }}">Login</a>
      </div>
    </div>
    </div>

  </section><!-- End Hero -->

  <section class="Contact Us">
    <div class="container-fluid d-flex flex-column flex-lg-row justify-content-around align-items-start px-5">
      <div class="col-12 col-lg-6 px-5">
        <h2><b>HUBUNGI KAMI</b></h2>
        <div class="d-flex flex-column">
          {{-- Notifikasi sukses --}}
@if(session('success'))
<div class="alert alert-success mt-3">
    {{ session('success') }}
</div>
@endif

{{-- Validasi error --}}
@if ($errors->any())
<div class="alert alert-danger mt-3">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

          <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <label for="">Nama</label>
            <input type="text" name="name" class="form-control">
          
            <label for="">E-mail</label>
            <input type="email" name="email" class="form-control">
          
            <label for="">Pesan</label>
            <textarea name="message" class="form-control"></textarea>
          
            <button type="submit" class="btn btn-primary my-3">Submit</button>
          </form>
          
        </div>
      </div>
  
      <div class="col-12 col-lg-6 px-4 mt-4 mt-lg-0 d-flex flex-column align-items-center">
        <div id="map" class="w-75" style="height: 300px; border-radius: 20px;"></div>
        <a href="https://www.google.com/maps/place/Jl.+Merdeka,+Gondek,+Kec.+Mojowarno,+Kabupaten+Jombang,+Jawa+Timur/@-7.6222691,112.2788456,283m/data=!3m1!1e3!4m6!3m5!1s0x2e786985cf8d211b:0xc44807a69f9372f8!8m2!3d-7.6220162!4d112.2793898!16s%2Fg%2F11fls24wq6?entry=ttu&g_ep=EgoyMDI1MDIxOS4xIKXMDSoASAFQAw%3D%3D"
           class="my-3" target="_blank">Buka di Google Maps</a>
      </div>
    </div>
  </section>

  
  


  <main id="main">


    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        var map = L.map('map').setView([-7.621994387820153, 112.27937955929923], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker([-7.621994387820153, 112.27937955929923]).addTo(map)
          .bindPopup('PT Mutiara Putri Gemilang')
          .openPopup();
      });
    </script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('landingpage/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/tether/js/tether.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/jquery-sticky/jquery.sticky.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/lockfixed/jquery.lockfixed.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/superfish/superfish.min.js') }}"></script>
    <script src="{{ asset('landingpage/assets/vendor/hoverIntent/hoverIntent.js') }}"></script>


    <!-- Template Main JS File -->
    <script src="{{ asset('landingpage/assets/js/main.js') }}"></script>
<!-- ======= Footer ======= -->
<footer style="background-color: #292B78; color: white; padding: 30px 0;">
  <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center text-center text-lg-start">
    
    <!-- Logo dan Nama Perusahaan -->
    <div class="mb-4 mb-lg-0">
      <img src="{{ asset('landingpage/assets/img/logo-ptmpg-putih.png') }}" alt="Logo PT Mutiara Putri Gemilang" width="150">
      <div style="font-weight: bold; margin-top: 10px;">
        PT. MUTIARA PUTRI GEMILANG<br>
        <small>PROPERTY REAL ESTATE</small>
      </div>
    </div>

    <!-- Copyright -->
    <div class="mb-4 mb-lg-0">
      © 2024 CycleTech. All Rights Reserved.
    </div>

    <!-- Kontak -->
    <div>
      <div>Email : ptmpg@gmail.com</div>
      <div>+6285755262701</div>
      <div>Jln. Merdeka Ds. Gondek Kec. Mojowarno, Jombang</div>
    </div>

  </div>
</footer>
</body>
</html>
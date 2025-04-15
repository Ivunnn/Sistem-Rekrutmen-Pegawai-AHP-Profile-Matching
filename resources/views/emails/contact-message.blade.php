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
  * License: https://bootstrapmade.com/license/<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PT Mutiara Putri Gemilang</title>
  <link rel="icon" href="{{ asset('landingpage/assets/img/favicon.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('landingpage/assets/img/apple-touch-icon.png') }}">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link href="{{ asset('landingpage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landingpage/assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2 class="text-center">Pesan Baru dari Form Kontak</h2>
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <p><strong>Nama:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Pesan:</strong></p>
        <p>{{ $data['message'] }}</p>
      </div>
    </div>
  </div>
</body>
</html>
  ======================================================== -->
</head>
<body>
  <h2>Pesan Baru dari Form Kontak</h2>
  <p><strong>Nama:</strong> {{ $data['name'] }}</p>
  <p><strong>Email:</strong> {{ $data['email'] }}</p>
  <p><strong>Pesan:</strong></p>
  <p>{{ $data['message'] }}</p>
</body>
</html>
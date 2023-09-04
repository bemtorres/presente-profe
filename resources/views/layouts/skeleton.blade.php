<!DOCTYPE html>
<html lang="en">
<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  {{-- <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template"> --}}
  {{-- <meta name="author" content="Łukasz Holeczek"> --}}
  {{-- <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard"> --}}
  <title>Planificador Académico</title>
  <link rel="manifest" href="{{ asset('app/assets/favicon/manifest.json') }}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('app/assets/favicon/ms-icon-144x144.png') }}">
  <meta name="theme-color" content="#ffffff">
  <!-- Vendors styles-->
  <link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('app/css/vendors/simplebar.css') }}">
  <!-- Main styles for this application-->
  <link href="{{ asset('app/css/style.css') }}" rel="stylesheet">

  <style>
    .sidebar {
      background: #1a1a1a !important;
    }

    .sidebar-nav .nav-link {
      color: #e5e5e5 !important;
    }

    .nav-icon {
      color: rgba(255, 184, 0, 1) !important;
    }
  </style>
</head>
<body>
  @include('layouts._menu')
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    @include('layouts._nav')
    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
        @yield('app')
      </div>
    </div>
    @include('layouts._footer')
  </div>
  <script src="{{ asset('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
  <script src="{{ asset('vendors/simplebar/js/simplebar.min.js') }}"></script>
</body>
</html>

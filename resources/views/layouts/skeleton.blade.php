<!DOCTYPE html>
<html lang="en">
<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="author" content="Bemtorres">
  <title>Planificador Académico</title>
  {{-- <link rel="manifest" href="{{ asset('app/assets/favicon/manifest.json') }}"> --}}
  {{-- <meta name="msapplication-TileColor" content="#ffffff"> --}}
  {{-- <meta name="msapplication-TileImage" content="{{ asset('app/assets/favicon/ms-icon-144x144.png') }}"> --}}
  {{-- <meta name="theme-color" content="#ffffff"> --}}
  <!-- Vendors styles-->
  <link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('app/css/vendors/simplebar.css') }}">
  <link href="{{ asset('app/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
  @stack('css')
</head>
<body>
  @include('layouts._menu')
  <div class="wrapper d-flex flex-column min-vh-100 bg-light text-sm">
    @include('layouts._nav')
    <div class="body flex-grow-1 px-3">
      <div class="container-lg text-sm">
        <div id="app">
          @yield('app')
        </div>
      </div>
    </div>
    @include('layouts._footer')
  </div>

  @vite(['resources/js/app.js'])
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{ asset('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
  <script src="{{ asset('vendors/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('vendors/bemtorres/main.js') }}"></script>
  @stack('js')
</body>
</html>

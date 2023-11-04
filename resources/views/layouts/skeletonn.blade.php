<!DOCTYPE html>
<html lang="en">
<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="author" content="Bemtorres">
  <title>Comparte Duoc</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('template/img/comparte-icono.svg') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/vendors/simplebar.css') }}">
  <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lato-font/3.0.0/css/lato-font.min.css" integrity="sha512-rSWTr6dChYCbhpHaT1hg2tf4re2jUxBWTuZbujxKg96+T87KQJriMzBzW5aqcb8jmzBhhNSx4XYGA6/Y+ok1vQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.cdnfonts.com/css/merriweather" rel="stylesheet">
  <style>
    body {
      background: #04243c;
      font-family: 'Lato', 'Merriweather', sans-serif;
    }
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
  <link href="{{ asset('template/css/comparteduoc.css') }}" rel="stylesheet">
  @stack('css')
</head>
<body>
  @include('layouts._menu')
  <div class="wrapper d-flex flex-column min-vh-100 bg-light text-sm">
    @include('layouts._nav')
    <div class="body flex-grow-1 px-3">
      <div class="container-lg text-sm">
        <div id="">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @include('components._toast')
  @stack('js')
</body>
</html>

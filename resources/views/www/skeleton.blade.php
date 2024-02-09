<!DOCTYPE html>
<html lang="es">
<head>
  <title>@yield('title', 'Gestion de asistencia - Presente profe')</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{ asset('images/pp.svg') }}" />

  <link rel="stylesheet" href="{{ asset('theme2/vendors/owl-carousel/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme2/vendors/owl-carousel/css/owl.theme.default.css') }}">
  <link rel="stylesheet" href="{{ asset('theme2/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme2/vendors/aos/css/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('theme2/css/style.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  @stack('stylesheet')
</head>
<body id="body" data-spy="scroll" data-target=".navbar" data-offset="100">
  @yield('app')
  <script src="{{ asset('theme2/vendors/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('theme2/vendors/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('theme2/vendors/owl-carousel/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('theme2/vendors/aos/js/aos.js') }}"></script>
  <script src="{{ asset('theme2/js/landingpage.js') }}"></script>
  @stack('javascript')
</body>
</html>

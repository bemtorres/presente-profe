<!DOCTYPE html>
<html lang="es">
<head>
  <title>Portal - Bootstrap 5 Admin Dashboard Template For Developers</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico">
  <script defer src="{{ asset('template/assets/plugins/fontawesome/js/all.min.js') }}"></script>
  <link id="theme-style" rel="stylesheet" href="{{ asset('template/assets/css/portal.css') }}">
  @stack('stylesheet')
</head>
<body class="app">
  @yield('app')
  <script src="{{ asset('template/assets/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('template/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('template/assets/plugins/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('template/assets/js/index-charts.js') }}"></script>
  <script src="{{ asset('template/assets/js/app.js') }}"></script>
  @stack('javascript')
</body>
</html>

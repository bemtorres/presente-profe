<!DOCTYPE html>
<html lang="es">
<head>
  <title>Presente profe | La mejor plataforma para tus clases</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ asset('img/profile.png') }}">
  <script defer src="{{ asset('template/assets/plugins/fontawesome/js/all.min.js') }}"></script>
  <link id="theme-style" rel="stylesheet" href="{{ asset('template/assets/css/portal.css') }}">
  <link href="{{ asset('vendors/toastify/toastify.min.css') }}" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f7fa;
    }

    .link-body-emphasis:hover, .link-body-emphasis:focus {
    color: none !important;
    text-decoration-color: none!important;
    }

    .dropdown-toggle:hover {
      color: #ffffff !important;
    }
  </style>
  @stack('css')
</head>

<body class="">
  @yield('app')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('template/assets/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('template/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('template/assets/js/app.js') }}"></script>
  <script src="{{ asset('vendors/toastify/toastify-js.js') }}"></script>
  @include('components._toastify')
  @stack('js')
</body>
</html>

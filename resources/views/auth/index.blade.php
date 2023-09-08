<!DOCTYPE html>
<html lang="en">
<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>CoreUI Free Bootstrap Admin Template</title>
  {{-- <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('app/assets/favicon/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('app/assets/favicon/apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('app/assets/favicon/apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('app/assets/favicon/apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('app/assets/favicon/apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('app/assets/favicon/apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('app/assets/favicon/apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('app/assets/favicon/apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('app/assets/favicon/apple-icon-180x180.png') }}">
  <link rel="icon" type="image/png" sizes="192x192"
      href="{{ asset('app/assets/favicon/android-icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('app/assets/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('app/assets/favicon/favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('app/assets/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('app/assets/favicon/manifest.json') }}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('app/assets/favicon/ms-icon-144x144.png') }}">
  <meta name="theme-color" content="#ffffff"> --}}
  <link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('app/css/vendors/simplebar.css') }}">
  <link href="{{ asset('app/css/style.css') }}" rel="stylesheet">
  {{-- <link href="{{ asset('app/css/examples.css') }}" rel="stylesheet"> --}}
</head>
<div class="bg-dark min-vh-100 d-flex flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card-group d-block d-md-flex row">
          <div class="d-none d-sm-none d-md-block card col-md-5 py-5" style="background-image: url('{{ asset('app/pexels-jess-bailey-designs-768472.jpg') }}'); background-size: cover;">
            <div class="card-body text-center">
              <div>
                <img src="{{ asset('app/img/planificadoracademico3.png') }}" alt="" srcset="">
              </div>
            </div>
          </div>
          <div class="card col-md-7 p-4 mb-0">
            <div class="card-body">
                <h1>Acceso</h1>
                {{-- <p class="text-medium-emphasis">Sign In to your account</p> --}}
                <form action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="correo" class="form-label">Correo electronico</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>

                  <div class="d-grid">
                      <button class="btn btn-primary" type="submit">Iniciar sesión</button>

                      {{-- <a class="btn btn-light mt-3" type="submit">
                        Iniciar con
                      </a> --}}
                  </div>
                  <div class="col-12 text-center">
                      {{-- <button class="btn btn-link px-0" type="button"><small>¿He olvidado mi contraseña?</small></button> --}}
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
<script src="{{ asset('vendors/simplebar/js/simplebar.min.js') }}"></script>
</body>
</html>

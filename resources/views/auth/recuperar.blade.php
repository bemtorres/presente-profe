<!DOCTYPE html>
<html lang="es">
<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="author" content="Bemtorres">
  <title>Comparte Duoc</title>
  <link rel="shortcut icon" href="{{ asset('template/img/comparte-icono.svg') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/vendors/simplebar.css') }}">
  <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('template/css/comparteduoc.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lato-font/3.0.0/css/lato-font.min.css" integrity="sha512-rSWTr6dChYCbhpHaT1hg2tf4re2jUxBWTuZbujxKg96+T87KQJriMzBzW5aqcb8jmzBhhNSx4XYGA6/Y+ok1vQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.cdnfonts.com/css/merriweather" rel="stylesheet">
  <style>
    body {
      background: #04243c;
      font-family: 'Lato', 'Merriweather', sans-serif;
    }
  </style>
  @laravelPWA
</head>
  <div class="bg-cd-primary min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="card shadow-lg">
            <div class="card-body row">
              <div class="d-none d-sm-none d-md-block col-md-6 py-5" style="background-image: url('{{ asset('template/img/fondo.jpg') }}'); background-size: cover;">
                <div class="justify-content-center align-content-center d-flex flex-wrap">
                  <div>
                    <img src="{{ asset('template/img/comparte-logo2.svg') }}" alt="" width="150px" srcset="">
                  </div>
                </div>
              </div>
              <div class="col-md-6 p-3">
                <div class="text-center d-md-none">
                  <img src="{{ asset('template/img/comparte-logo2.svg') }}" width="120px">
                </div>
                <h1>Recuperar contraseña</h1>

                {{-- <p class="text-medium-emphasis">Sign In to your account</p> --}}
                <form class="form-sample form-submit" action="{{ route('recuperar') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico @if (session('info'))
                      <span class="badge bg-danger">Error. intente nuevamente</span>
                    @endif
                    @if (session('success'))
                    <span class="badge bg-success">Se ha enviado una solicitud a tu correo</span>
                  @endif
                  </label>
                    <input type="email" class="form-control" autofocus autocomplete="off" id="correo" name="correo" value="" required>
                  </div>
                  <div class="d-grid">
                      <button class="btn btn-warning mb-3" type="submit"><strong>Resetear contraseña</strong></button>
                      <a class="btn btn-dark" href="{{ route('root') }}">Volver</a>
                  </div>
                  <div class="col-12 text-end mt-4">
                      {{-- <button class="btn btn-link px-0" type="button"><small>¿He olvidado mi contraseña?</small></button> --}}
                    <strong><small><span class="badge bg-dark">v0.1.0</span></small></strong>
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

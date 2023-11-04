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
                <h1>Acceso</h1>

                {{-- <p class="text-medium-emphasis">Sign In to your account</p> --}}
                <form class="form-sample form-submit" action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico @if (session('info'))
                      <span class="badge bg-danger">Error. intente nuevamente</span>
                    @endif</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>

                  <div class="d-grid">
                      <button class="btn btn-primary" type="submit">Iniciar sesión</button>

                      <br>

                      <a href="{{ url('auth/google') }}" class="btn btn-sm btn-light btn-lg">
                        <span aria-hidden="true" class="NA_Img dkWypw"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M20.64 12.2c0-.63-.06-1.25-.16-1.84H12v3.49h4.84a4.14 4.14 0 0 1-1.8 2.71v2.26h2.92a8.78 8.78 0 0 0 2.68-6.62z" fill="#4285F4"></path><path d="M12 21a8.6 8.6 0 0 0 5.96-2.18l-2.91-2.26a5.4 5.4 0 0 1-8.09-2.85h-3v2.33A9 9 0 0 0 12 21z" fill="#34A853"></path><path d="M6.96 13.71a5.41 5.41 0 0 1 0-3.42V7.96h-3a9 9 0 0 0 0 8.08l3-2.33z" fill="#FBBC05"></path><path d="M12 6.58c1.32 0 2.5.45 3.44 1.35l2.58-2.59A9 9 0 0 0 3.96 7.95l3 2.34A5.36 5.36 0 0 1 12 6.58z" fill="#EA4335"></path></g></svg></span>
                        Inicia sesión con Google
                      </a>
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

<!DOCTYPE html>
<html lang="es">
<head>
  <title>Presente Profe - Bitacoras PRO</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico">
  <script defer src="{{ asset('template/assets/plugins/fontawesome/js/all.min.js') }}"></script>
  <link id="theme-style" rel="stylesheet" href="{{ asset('template/assets/css/portal.css') }}">
  <link href="{{ asset('vendors/toastify/toastify.min.css') }}" rel="stylesheet" />
  <style>
    .app-auth-wrapper {
      /* background-color: #cdcdcd !important; */
    }
  </style>
</head>
<body class=" app-login p-0">
  <div class="row g-0 app-auth-wrapper">
    {{-- <div class="d-none d-md-block col p-5">
      <img src="{{ asset('images/check.svg') }}" width="100%" alt="">
    </div> --}}
    <div class="col-12 text-center">
      <div class="d-flex flex-column ">
        <div class="app-auth-body mx-auto">
          <div class="app-auth-branding mb-4">
            <img class="logo-icon me-2" src="{{ asset('images/presenteprofe1.png') }}" width="200px" alt="logo">
          </div>
          {{-- <h2 class="auth-heading text-center mb-3">Log in to Portal</h2> --}}
          <div class="text-start">
            <form action="{{ route('auth.registro') }}" method="post" class="form-submit row">
              @csrf
              <div class="mb-3">
                <label for="run" class="form-label">Rut<small class="text-danger">*</small></label>
                <input type="text" class="form-control" name="run" placeholder=""
                    required="" maxlength="9" min="8" autocomplete="off" onkeyup="this.value = validarRut(this.value)">
              </div>
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre<small class="text-danger">*</small></label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" required>
              </div>
              <div class="mb-3">
                <label for="nombre" class="form-label">Apellido paterno<small class="text-danger">*</small></label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" required>
              </div>
              <div class="mb-3">
                <label for="nombre" class="form-label">Apellido materno<small class="text-danger">*</small></label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" required>
              </div>
              <div class="mb-3 col-md-12">
                <label for="correo" class="form-label">Correo<small class="text-danger">*</small></label>
                <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correo" required>
              </div>
              <div class="mb-3 col-md-12">
                <label for="codigo" class="form-label">Código de invitación<small class="text-danger">*</small></label>
                <input type="text" class="form-control" id="codigo" name="codigo" aria-describedby="codigo" required>
              </div>
              <div class="d-grid gap-3">
                <button type="submit" class="btn app-btn-primary mb-3">REGISTRAR</button>
                <a href="{{ route('root') }}" class="btn app-btn-secondary">VOLVER</a>
              </div>
            </form>
          </div>
        </div>
        <footer class="app-auth-footer" hidden>
          <div class="container text-center py-3">
            <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
            <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart"
                style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com"
                target="_blank">Xiaoying Riley</a> for developers</small>

          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('vendors/bemtorres/validate-run.js') }}"></script>
  <script src="{{ asset('vendors/bemtorres/main.js') }}"></script>
  <script src="{{ asset('vendors/toastify/toastify-js.js') }}"></script>
  @include('components._toastify')
</body>
</html>

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
</head>
<body class="app app-login p-0">
  <div class="row g-0 app-auth-wrapper">
    <div class="d-none d-md-block col-lg-6 p-5">
      <img src="{{ asset('images/check.svg') }}" width="100%" alt="">
    </div>
    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
      <div class="d-flex flex-column align-content-end">
        <div class="app-auth-body mx-auto">
          <div class="app-auth-branding mb-4">
            <img src="{{ asset('images/presenteprofe1.png') }}" width="200px" alt="">
          </div>
          <h2 class="auth-heading text-center mb-5">Iniciar sesión</h2>
          <div class="auth-form-container text-start">
            <form action="{{ route('auth.login') }}" method="post" class="form-submit">
              @csrf
              <div class="mb-3">
                <label for="correo" class="form-label">Correo<small class="text-danger">*</small></label>
                <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correo" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña<small class="text-danger">*</small></label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="d-grid gap-3">
                <button type="submit" class="btn app-btn-primary mb-3">INICIAR SESIÓN</button>
                <a href="{{ route('auth.registro') }}" class="btn app-btn-secondary">CREAR NUEVA CUENTA</a>
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
  <script src="{{ asset('vendors/bemtorres/main.js') }}"></script>
  <script src="{{ asset('vendors/toastify/toastify-js.js') }}"></script>
  @include('components._toastify')
</body>
</html>

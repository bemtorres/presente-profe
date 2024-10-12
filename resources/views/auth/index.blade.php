<!DOCTYPE html>
<html lang="es">
<head>
  <title>Presente Profe - Bitacoras PRO</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico">
  <script defer src="{{ asset('template/assets/plugins/fontawesome/js/all.min.js') }}"></script>
  {{-- <link id="theme-style" rel="stylesheet" href="{{ asset('template/assets/css/portal.css') }}"> --}}
  <link href="{{ asset('vendors/toastify/toastify.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/logins/login-9/assets/css/login-9.css">
  <style>

    body {
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      text-align: left;
      background: rgb(0,0,0);
      background: linear-gradient(180deg, rgba(0,0,0,1) 0%, rgba(26,26,26,1) 22%, rgba(26,26,26,1) 88%);

      /* background-color: 8f9fc; */
    }

  </style>
</head>
<body class="bg-dark">
  <section class="py-3 py-md-5 py-xl-8">
    <div class="container">
      <div class="row gy-4 align-items-center">
        <div class="col-12 col-md-6 col-xl-7 d-none d-md-block">
          <div class="d-flex justify-content-center">
            <div class="col-12 col-xl-9">
              <img class="img-fluid rounded mb-4"  src="{{ asset('img/presentprofe2.png') }}" alt="">
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-5">
          <div class="card border-0 rounded-4">
            <div class="card-body p-3 p-md-4 p-xl-5">
              <div class="row">
                <div class="col-12">
                  <div class="mb-1">
                    {{-- <h3></h3> --}}
                    <img src="{{ asset('img/logo-presente-profe.png') }}" class="img-fluid rounded mb-4"  alt="" srcset="">
                    {{-- <p>Don't have an account? <a href="#!">Sign up</a></p> --}}
                  </div>
                </div>
              </div>
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
                <div class="d-grid">
                  <button class="btn btn-success btn-lg" type="submit">INICIAR SESIÓN</button>
                </div>
                <br>
                <div class="w-100"></div>
                <div class="row">
                  <div class="col-6">
                    <a href="{{ route('auth.registro') }}" class="btn btn-dark btn-sm mt-2">CREAR NUEVA CUENTA</a>
                  </div>
                  <div class="col-6">
                    <a href="{{ route('auth.recuperar') }}" class="btn btn-warning btn-sm mt-2">RECUPERAR CONTRASEÑA</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('vendors/bemtorres/main.js') }}"></script>
  <script src="{{ asset('vendors/toastify/toastify-js.js') }}"></script>
  @include('components._toastify')
</body>
</html>

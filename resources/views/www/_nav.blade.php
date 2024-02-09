<header id="header-section">
  <nav class="navbar navbar-expand-lg pl-3 pl-sm-0" id="navbar">
  <div class="container">
    <div class="navbar-brand-wrapper d-flex w-100">
      <img src="{{ asset('images/presenteprofe1.png') }}" width="120"  alt="">
      <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="mdi mdi-menu navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse navbar-menu-wrapper" id="navbarSupportedContent">
      <ul class="navbar-nav align-items-lg-center align-items-start ml-auto">
        <li class="d-flex align-items-center justify-content-between pl-4 pl-lg-0">
          <div class="navbar-collapse-logo">
            <img src="{{ asset('images/logogana.svg') }}" width="40" alt="">
          </div>
          <button class="navbar-toggler close-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="mdi mdi-close navbar-toggler-icon pl-5"></span>
          </button>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#header-section">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#quehacemos">¿Qué hacemos?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#precios">Precios</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="#feedback-section">Testimonials</a>
        </li> --}}
        <li class="nav-item btn-contact-us pl-4 pl-lg-0">
          <button class="btn btn-primario" data-toggle="modal" data-target="#loginModal">Acceso docente</button>
        </li>
      </ul>
    </div>
  </div>
  </nav>
</header>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Inicio de Sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario de inicio de sesión -->
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" class="form-control" id="username" required autofocus>
          </div>
          <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" required>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Recordarme</label>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primario btn-block mt-3">Iniciar Sesión</button>
          </div>
        </form>

        <!-- Acceso con Gmail -->
        <hr>
        <div class="mb-3">
          <p class="text-center">o inicia sesión con</p>
          <button type="button" class="btn btn-secundario d-block mx-auto">Gmail</button>
        </div>
      </div>
    </div>
  </div>
</div>

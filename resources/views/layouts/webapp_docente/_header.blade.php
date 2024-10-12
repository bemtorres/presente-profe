<header class="p-3 mb-3 border-bottom bg-black ">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
        <img src="{{ asset('img/plano.png') }}" width="200" alt="">
      </a>

      <ul class="nav col-auto me-auto mb-2 justify-content-center mb-0">
        <li>
          {{-- <a href="#" class="ms-4 nav-link px-2 text-white btn app-btn-primary">
            COINS 0
          </a> --}}
        </li>
        {{-- <li><a href="#" class="nav-link px-2 link-body-emphasis">Inventory</a></li>
        <li><a href="#" class="nav-link px-2 link-body-emphasis">Customers</a></li>
        <li><a href="#" class="nav-link px-2 link-body-emphasis">Products</a></li> --}}
      </ul>

      <div class="dropdown text-end">
        <a href="#" class="d-none d-md-block link-body-emphasis text-decoration-none dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset(current_user()->getPhoto()) }}" alt="mdo" width="32" height="32" class="rounded-circle">
          {{ current_user()->nombre_completo() }}
        </a>
        <a href="#" class="d-md-none dropdown-toggle text-white btn app-btn-secondary btn-white" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset(current_user()->getPhoto()) }}" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small" style="">
          {{-- <li><a class="dropdown-item" href="#">New project...</a></li> --}}
          {{-- <li><a class="dropdown-item" href="#">Settings</a></li> --}}

          <li><span class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPerfilPassword">Cambiar contraseña</span></li>
          <li><span class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPerfil">Perfil</span></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesión</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

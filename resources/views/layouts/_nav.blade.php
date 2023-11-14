<header class="header header-sticky mb-4">
  <div class="container-fluid">
    <button class="header-toggler px-md-0 me-md-3" type="button"
      onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
      <svg class="icon icon-lg">
        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
      </svg>
    </button>

    <ul class="header-nav ms-3">
      <li class="nav-item dropdown">

        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-md">
              <img class="avatar-img" src="{{ current_user()->getImg() }}" alt="">
            </div>
            <div class="ms-2">
              <span class="h6 mt-2 mt-sm-0">{{ current_user()->nombre_completo() }}</span>
              <p class="small m-0">{{ current_user()->correo }}</p>
            </div>
          </div>
        </a>

        <div class="dropdown-menu dropdown-menu-end pt-0">
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{  route('admin.perfil') }}">
            <svg class="icon me-2">
              <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use>
            </svg> Perfil
          </a>
          {{-- <a class="dropdown-item" href="{{  route('home.tutorial') }}">
            <i class="fa-brands fa-youtube icon me-2 text-danger"></i>
            Tutoriales
          </a> --}}
          <a class="dropdown-item" href="{{ route('logout') }}">
            <svg class="icon me-2">
              <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}"></use>
            </svg> Salir
          </a>
        </div>
      </li>
    </ul>
  </div>
</header>

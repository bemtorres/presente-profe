<div class="sidebar sidebar-dark sidebar-fixed text-sm" id="sidebar">
  <div class="sidebar-brand d-none d-md-flex">
    {{-- <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
      <use xlink:href="{{ asset('app/img/planificadoracademico3.png') }}"></use>
    </svg>
    <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
      <use xlink:href="{{ asset('app/img/planificadoracademico3.png') }}"></use>
    </svg> --}}
    <img src="{{ asset('app/img/planificadoracademico3.png') }}" width="118" alt="">
  </div>
  <ul class="sidebar-nav {{ activeTab(["asignaturas*"]) }}" data-coreui="navigation" data-simplebar="">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home.index') }}">
        <i class="nav-icon fa-solid fa-house-chimney"></i>
        Inicio
      </a>
    </li>
    {{-- <li class="nav-title">Theme</li> --}}
    {{-- <li class="nav-item">
      <a class="nav-link" href="colors.html">
        <svg class="nav-icon">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-drop') }}"></use>
        </svg> Colors
      </a>
    </li> --}}
    {{-- <li class="nav-item">
      <a class="nav-link" href="typography.html">
        <svg class="nav-icon">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil') }}"></use>
        </svg> Typography
      </a>
    </li> --}}
    @if (current_user()->tipo_usuario == 1)
    <li class="nav-item">
      <a class="nav-link {{ activeTab(['planes*']) }}" href="{{ route('planes.index') }}">
        <i class="nav-icon fa-regular fa-clock"></i>
        <small>Disponibilidad Horaria</small>
      </a>
    </li>
    <li class="nav-title">Configuración</li>
    <li class="nav-group {{ activeOpen(['usuario*','asignaturas*']) }}"><a class="nav-link nav-group-toggle" href="#">
      <i class="nav-icon fa-solid fa-gear"></i> Admin</a>
      <ul class="nav-group-items">
        <li class="nav-item">
          <a class="nav-link {{ activeTab(['usuario*']) }}" href="{{ route('usuarios.index') }}">
            <span class="nav-icon"></span>
            Usuarios
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ activeTab(['asignaturas*']) }}" href="{{ route('asignaturas.index') }}">
            <span class="nav-icon"></span>
            Asignatura
          </a>
        </li>
      </ul>
    </li>
    @endif


    {{-- <li class="nav-item mt-auto"><a class="nav-link" href="https://coreui.io/docs/templates/installation/"
        target="_blank">
        <svg class="nav-icon">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-description') }}"></use>
        </svg> Docs</a></li>
    <li class="nav-item"><a class="nav-link nav-link-danger" href="https://coreui.io/pro/" target="_top">
        <svg class="nav-icon">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-layers') }}"></use>
        </svg> Try CoreUI
        <div class="fw-semibold">PRO</div>
      </a></li> --}}
  </ul>
  <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>

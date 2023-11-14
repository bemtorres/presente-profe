<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/usuarios"]) }}" href="{{ route('usuarios.index') }}">Usuarios</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/usuarios-admin"]) }}" href="{{ route('usuario.index.admin') }}">Administradores</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/usuarios-app"]) }}" href="{{ route('usuario.index.app') }}">Dispositivos</a>
  </li>
  {{-- <li class="nav-item"> --}}
    {{-- <a class="nav-link {{ activeTab(["admin/usuario/admins"]) }}" href="{{ route('admin.usuario.admin') }}">Admins</a> --}}
  {{-- </li> --}}
  {{-- <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/usuario/eliminados"]) }}" href="#">Eliminados</a>
  </li> --}}
  <li class="nav-item">
    <a class="nav-link" href="{{ route('usuarios.create') }}">Nuevo</a>
  </li>
</ul>

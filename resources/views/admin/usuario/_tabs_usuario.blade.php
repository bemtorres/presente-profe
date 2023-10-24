<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/usuarios/" . $u->id]) }}" href="{{ route('usuarios.show',$u->id) }}">{{ $u->nombre_completo() }}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/usuarios/" . $u->id . '/sedes']) }}" href="{{ route('usuarios.sedes',$u->id) }}">Sedes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/usuarios/" . $u->id . '/edit']) }}" href="{{ route('usuarios.edit',$u->id) }}">Editar</a>
  </li>
  <li class="nav-item">
    {{-- <a class="nav-link {{ activeTab(["admin/usuario/" . $u->id . '/historial']) }}" href="{{ route('usuario.historial',$u->id) }}">Historial</a> --}}
  </li>
</ul>

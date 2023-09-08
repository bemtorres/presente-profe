<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["asignaturas"]) }}" href="{{ route('asignaturas.index') }}">Asignaturas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["asignaturas/create"]) }}" href="{{ route('asignaturas.create') }}">Nuevo</a>
  </li>
</ul>

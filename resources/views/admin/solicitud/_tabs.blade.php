<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/solicitud"]) }}" href="{{ route('solicitud.index') }}">Pendientes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/solicitud-realizadas"]) }}" href="{{ route('solicitud.indexR') }}">Realizadas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/solicitud-canceladas"]) }}" href="{{ route('solicitud.indexC') }}">Canceladas</a>
  </li>
</ul>

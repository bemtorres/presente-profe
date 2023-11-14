<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/solicitud"]) }}" href="{{ route('solicitud.index') }}">
      <i class="fa-solid fa-heart text-warning"></i>
      Pendientes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/solicitud-aceptadas"]) }}" href="{{ route('solicitud.indexA') }}">
      <i class="fa fa-check text-success"></i>
      Aceptadas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/solicitud-rechazadas"]) }}" href="{{ route('solicitud.indexR') }}">
      <i class="fa fa-times text-danger"></i>
      Rechazadas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/solicitud-canceladas"]) }}" href="{{ route('solicitud.indexC') }}">
      <i class="fa-solid fa-circle-exclamation text-dark"></i>
      Canceladas por el usuario</a>
  </li>
</ul>

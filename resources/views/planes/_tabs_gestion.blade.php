<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id]) }}" href="{{ route('planes.show', $plan->id) }}">Contenido</a>
  </li>
  {{-- <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes"]) }}" href="{{ route('planes.index') }}">Planes</a>
  </li> --}}
  {{-- <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/compartir"]) }}" href="{{ route('planes.compartir', $plan->id) }}">Compartir</a>
  </li> --}}
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/participantes"]) }}" href="{{ route('planes.participantes', $plan->id) }}"><i class="fa fa-users me-2"></i> Participantes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/reporte"]) }}" href="{{ route('planes.reporte', $plan->id) }}"><i class="fa-solid fa-chart-simple me-2"></i>Reportes</a>
  </li>
  {{-- <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/reporte/listado"]) }}" href="{{ route('planes.reporte.listado', $plan->id) }}"><i class="fa-solid fa-chart-simple me-2"></i>Reportes Listado</a>
  </li> --}}

  {{-- <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/reporte/listado/export"]) }}" href="{{ route('planes.reporte.listado.export', $plan->id) }}"><i class="fa-solid fa-chart-simple me-2"></i>Reportes Listado Export</a> --}}

</ul>

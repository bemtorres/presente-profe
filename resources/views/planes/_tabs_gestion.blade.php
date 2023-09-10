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
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/participantes"]) }}" href="{{ route('planes.participantes', $plan->id) }}">Participantes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes"]) }}" href="{{ route('planes.index') }}">Reportes</a>
  </li>
</ul>

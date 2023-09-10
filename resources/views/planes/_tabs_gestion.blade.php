<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes"]) }}" href="{{ route('planes.index') }}">Planes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes"]) }}" href="{{ route('planes.index') }}">Planes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/compartir"]) }}" href="{{ route('planes.compartir', $plan->id) }}">Compartir</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/inscritos"]) }}" href="{{ route('planes.inscritos', $plan->id) }}">Inscritos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes"]) }}" href="{{ route('planes.index') }}">Reportes</a>
  </li>
</ul>

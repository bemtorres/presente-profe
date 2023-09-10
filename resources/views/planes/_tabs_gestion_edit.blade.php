<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/edit"]) }}" href="{{ route('planes.edit', $plan->id) }}">Editar</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/asignaturas"]) }}" href="{{ route('planes.asignaturas', $plan->id) }}">Asignaturas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/compartir"]) }}" href="{{ route('planes.compartir', $plan->id) }}">Compartir</a>
  </li>
</ul>

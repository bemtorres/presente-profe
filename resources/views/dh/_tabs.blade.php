<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["dh/".$plan->id]) }}" href="{{ route('disponibilidad.show', $plan->id) }}">Disponibilidad</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["dh/".$plan->id."/asignaturas"]) }}" href="{{ route('disponibilidad.asignaturas', $plan->id) }}">🎖️ Asignaturas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["dh/".$plan->id."/mis_asignaturas"]) }}" href="{{ route('disponibilidad.mis_asignaturas', $plan->id) }}">📖 Mis asignaturas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["dh/".$plan->id."/calendario"]) }}" href="{{ route('disponibilidad.calendario',$plan->id) }}">📅 Calendario</a>
  </li>
  {{-- <li class="nav-item">
    <a class="nav-link {{ activeTab(["dh/".$plan->id."/calendario"]) }}" href="{{ route('disponibilidad.calendario',$plan->id) }}">🚫 Reportar inasistencia</a>
  </li> --}}
</ul>

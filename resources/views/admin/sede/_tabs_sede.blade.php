<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/sedes/" . $s->id]) }}" href="{{ route('sedes.show',$s->id) }}">Sede</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["admin/sedes/" . $s->id . "/salas"]) }}" href="{{ route('sedes.sala',$s->id) }}">Salas</a>
  </li>
</ul>

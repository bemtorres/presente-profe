<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(['webapp-docente/espacios/' . $e->id]) }}" aria-current="page" href="{{ route('webappdocente.espacios.show', $e->id) }}">Mi espacio</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(['webapp-docente/espacios/' . $e->id . '/edit']) }}" href="{{ route('webappdocente.espacios.edit', $e->id) }}">Editar</a>
  </li>

  <li class="nav-item">
    <a class="nav-link {{ activeTab(['webapp-docente/espacios/' . $e->id . '/matricula']) }}" href="{{ route('webappdocente.espacios.matricula.index', $e->id) }}">Matricula</a>
  </li>

  <li class="nav-item">
    <a class="nav-link {{ activeTab(['webapp-docente/espacios/' . $e->id . '/clases']) }}" href="{{ route('webappdocente.espacios.clases', $e->id) }}">Clases</a>
  </li>

  <li class="nav-item">
    <a class="nav-link {{ activeTab(['webapp-docente/espacios/' . $e->id . '/clases-calendario']) }}" href="{{ route('webappdocente.espacios.clases-calendario', $e->id) }}">Calendario</a>
  </li>

  <li class="nav-item">
    <a class="nav-link {{ activeTab(['webapp-docente/espacios/' . $e->id . '/anuncios']) }}" href="{{ route('webappdocente.espacios.anuncio', $e->id) }}">Anuncios</a>
  </li>




</ul>

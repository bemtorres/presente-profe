<div class="card text-start">
  <img class="card-img-top" src="{{ asset($e->getPhoto()) }}" alt="Title" />
  <div class="card-body">
    <h4 class="card-title">{{ $e->nombre }}</h4>
    <p class="card-text">{{ $e->sigla }}</p>


    <div class="list-group">
      <a href="{{ route('admin.espacio.show', $e->id) }}" class="list-group-item list-group-item-action {{ activeTab(['admin/espacios/' . $e->id]) }}" aria-current="true">
        Mi espacio
      </a>
      <a href="{{ route('admin.espacio.edit', $e->id) }}" class="list-group-item list-group-item-action {{ activeTab(['admin/espacios/' . $e->id . '/edit']) }}">Editar</a>
      <a href="{{ route('admin.espacio.matricula', $e->id) }}" class="list-group-item list-group-item-action {{ activeTab(['admin/espacios/' . $e->id . '/matricula']) }}">Matricula</a>
      <a href="{{ route('admin.espacio.clases', $e->id) }}" class="list-group-item list-group-item-action {{ activeTab(['admin/espacios/' . $e->id . '/clases']) }}">Clases</a>
      {{-- <a href="{{ route('admin.espacio.compartir', $e->id) }}" class="list-group-item list-group-item-action {{ activeTab(['admin/espacios/' . $e->id . '/compartir']) }}">Compartir</a> --}}
      {{-- <a href="{{ route('admin.espacio.compartir', $e->id) }}" class="list-group-item list-group-item-action {{ activeTab(['admin/espacios/' . $e->id . '/compartir']) }}">Asistencia</a> --}}
      {{-- <a href="#" class="list-group-item list-group-item-action">A fourth link item</a> --}}
      {{-- <a class="list-group-item list-group-item-action disabled" aria-disabled="true">A disabled link item</a> --}}
    </div>
  </div>
</div>



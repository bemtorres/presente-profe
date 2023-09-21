@extends('layouts.app')
@push('css')

<style>
.list-group-item-selected {
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}
#lista {
  display: none;
}

.cursor {
  cursor: pointer;
}
</style>
@endpush
@section('content')
@component('components.button._back')
@slot('route', route('planes.participantes', $plan->id))
@slot('color', 'secondary')
@slot('body', '<small>Participante - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent
@include('planes.id.participantes._tabs')
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="card">
              <div class="card-body">
                <ul class="list-group cursor">
                  <li class="list-group-item d-flex justify-content-between align-items-center" id="mostrarLista">
                    <div class="d-flex align-items-center">
                      <div class="avatar avatar-md">
                        <img class="avatar-img" src="{{ $u->getImg() }}" alt="">
                      </div>
                      <div class="ms-2">
                        <span class="h6 mt-2 mt-sm-0">{{ $u->nombre_completo() }}</span>
                        <p class="small m-0">{{ $u->correo }}</p>
                      </div>
                    </div>
                    <div class="text-end">
                      <i class="fa fa-chevron-down"></i>
                    </div>
                  </li>
                </ul>
                <ul class="list-group" id="lista" style="display: none;">
                  @foreach ($plan->asociado_plan as $a)
                    @continue($a->id_usuario == $u->id)
                    <li class="list-group-item list-group-item-action d-flex cursor" onclick="window.location = '{{ route('planes.participantes.showPDF',[$plan->id, $a->id]) }}'">
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-md">
                          <img class="avatar-img" src="{{ $a->usuario->getImg() }}" alt="">
                        </div>
                        <div class="ms-2">
                          <span class="h6 mt-2 mt-sm-0">{{ $a->usuario->nombre_completo() }}</span>
                          <p class="small m-0">{{ $a->usuario->correo }}</p>
                        </div>
                      </div>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>

        </div>
        <div class="row justify-content-center">
          <div class="col-md-12 text-center mb-3">
            <a href="{{ route('pdf.diponibilidad', [$plan->id, $asociado->id]) }}" class="btn btn-danger btn-sm text-white"><i class="fa fa-file-pdf me-2"></i><strong>VER PDF</strong></a>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <iframe src="{{ route('pdf.diponibilidad',[$plan->id, $asociado->id]) }}" style="width:100%; height:700px;" frameborder="0" ></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script>
  $(document).ready(function () {
    // Manejar el clic en el botón "Mostrar Lista"
    $("#mostrarLista").click(function () {
      $("#lista").slideToggle();
    });

    // Manejar la selección de elementos de la lista
    $("#lista li").click(function () {
      // Desmarcar todos los elementos
      $("#lista li").removeClass("list-group-item-selected");

      // Marcar el elemento seleccionado
      $(this).addClass("list-group-item-selected");
    });
  });
  </script>

@endpush

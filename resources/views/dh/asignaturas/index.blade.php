@extends('layouts.appp')
@push('css')
<style>
  .handle {
    cursor: move;
  }
</style>
@endpush
@section('content')
@component('components.button._back')
@slot('route', route('home.index'))
@slot('color', 'secondary')
@slot('body', '<small>Disponibilidad Horaria - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent

@if ($plan->estado == 3)
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-danger" role="alert">
      <p class="mb-0">📣 La edición de <strong>disponibilidad horaria</strong> ha sido desactivada.</p>
    </div>
  </div>
</div>
@endif
@include('dh._tabs')
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="row p-3">
        <div class="mb-3">
          <a href="{{ route('disponibilidad.asignaturas.create',$plan->id) }}" class="btn btn-primary">Registrar asignatura</a>
        </div>
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Priorización</th>
                      <th>Nombre</th>
                      <th>Sigla</th>
                      <th>Carrera</th>
                    </tr>
                  </thead>
                  <tbody id="items">
                    @forelse ($asignaturas_preferidas as $key => $ap)
                      <tr data-id="{{ $ap->id }}" data-position="{{ $ap->posicion }}">
                        <td  class="handle">
                          <i class="fa fa-arrows-alt"></i>
                        </td>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $ap->asignatura->nombre }}</td>
                        <td>{{ $ap->asignatura->sigla }}</td>
                        <td>{{ $ap->asignatura->carrera }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="text-center">No hay asignaturas registradas</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
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

  <script src="{{ asset('vendors/sortableJS/js/Sortable.js') }}"></script>
  <script>

    const url = "{{ route('api.interna.measignatura.changePosition', $plan->id) }}";
    var el = document.getElementById('items');

    var sortable = Sortable.create(el, {
      animation: 300,
      handle: '.handle',
      sort: true,
      chosenClass: 'active',
      dataIdAttr: 'data-id',
      onEnd: function(evt) {
        var list = sortable.toArray();
        changePosition(list);
      }
    });

    function changePosition(list){
      axios
        .put(url, {
          list,
          code: "{{ $plan->id }}"
        })
        .then(response => {
          console.log(response);
          popup(response);
        })
        .catch(e => {
          console.log(e);
        })
    };

    function popup(response){
      let { status } = response;
      let { message } = response.data;

      if(status == 200){
        iziToast.success({
          backgroundColor: '#47c363',
          message
        });
      }
    }
  </script>
@endpush

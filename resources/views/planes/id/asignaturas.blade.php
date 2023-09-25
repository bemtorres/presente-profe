@extends('layouts.appp')
@push('css')

{{-- <link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
<style>
  .handle {
    cursor: move;
  }
</style>
@endpush
@section('content')
@component('components.button._back')
@slot('route', route('planes.show', $plan->id))
@slot('color', 'secondary')
@slot('body', '<small>Asignaturas - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent
@include('planes._tabs_gestion_edit')
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="row p-2">
        <div class="mb-3">

          <a href="{{ route('planes.asignaturasAdd',$plan->id) }}" class="btn btn-primary btn-sm">Registrar asignatura</a>
        </div>
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      {{-- <th>id</th> --}}
                      <th>Código</th>
                      <th>Nombre</th>
                      <th>Semestre</th>
                      <th>Programa</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="items">
                    @foreach ($plan->detalle_plan as $dp)
                    <tr data-id="{{ $dp->id }}" data-position="{{ $dp->posicion }}">
                      <td  class="handle">
                        <i class="fa fa-arrows-alt"></i>
                      </td>
                      <td>{{ $dp->asignatura->sigla }}</td>
                      <td>{{ $dp->asignatura->nombre }}</td>
                      <td>{{ $dp->asignatura->semestre }}</td>
                      <td>{{ $dp->asignatura->programa }}</td>
                      <td>
                        @if ($dp->asignatura->getFile())
                          <a href="{{ asset($dp->asignatura->getPDF()) }}" target="_blank" class="btn btn-danger btn-sm text-white"><i class="fa fa-file-pdf me-2"></i><strong>VER PDF</strong></a>
                        @endif
                        @if ($dp->asignatura->getUrl())
                        <a href="{{ $dp->asignatura->getUrl() }}" target="_blank" class="btn btn-sm btn-dark me-2"><strong>LINK</strong></a>
                        @endif
                      </td>
                    </tr>
                    @endforeach
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
  {{-- <script src="{{ asset('vendors/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });
  </script> --}}

  <script src="{{ asset('vendors/sortableJS/js/Sortable.js') }}"></script>
  <script>

    const url = "{{ route('api.interna.asignatura.changePosition', $plan->id) }}";
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

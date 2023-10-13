@extends('layouts.appp')
@push('css')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">


<style>
  .moveall, .removeall {
    border: 1px solid #ccc !important;

    &:hover {
      background: #efefef;
    }
  }
  .moveall::after {
    content: attr(title);
  }

  .removeall::after {
    content: attr(title);
  }

  .form-control option {
      padding: 10px;
      border-bottom: 1px solid #efefef;
  }
</style>

@endpush
@section('content')
@component('components.button._back')
@slot('route',  route('planes.participantes.asignatura', [$plan->id, $ap->id]))
@slot('color', 'secondary')
@slot('body', '<small>Inscribir asignatura - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form class="form-sample form-submit" action="{{ route('disponibilidad.asignaturas.store.main',[$plan->id, $ap->id_usuario]) }}" method="post">
          @csrf
          <div class="col-md-12 mb-3">
            <select  size="10" class="form-control select2 {{ $errors->has('asignaturas_ids') ? 'is-invalid' : '' }} " data-dropdown-css-class="select2-green" style="width: 100%;" multiple="multiple" id="asignaturas_ids" name="asignaturas_ids[]">
            @foreach  ($plan->detalle_plan as $dp)
              <option {{ $dp->selected ? 'selected' : '' }} value="{{ $dp->asignatura->id }}">[{{ $dp->asignatura->semestre }}] {{ $dp->asignatura->toString() }}</option>
            @endforeach
            </select>
          </div>
          <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection
@push('js')
<script src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js"></script>

<script>
  var demo1 = $('select[name="asignaturas_ids[]"]').bootstrapDualListbox({
    nonSelectedListLabel: 'Asignaturas sin asignar',
    selectedListLabel: 'Asigntaras registradas',
    preserveSelectionOnMove: 'Mover',
    moveAllLabel: 'Mover todos',
    removeAllLabel: 'Remover todos'
  });
</script>
@endpush

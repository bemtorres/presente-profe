@extends('layouts.appp')
@push('css')

{{-- <link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
{{-- <link rel="stylesheet" href="{{ asset('vendors/duallistbox/bootstrap-duallistbox.css') }}"> --}}

<!-- common libraries -->
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}

<!-- plugin -->

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
@slot('route', route('planes.asignaturas',$plan->id))
@slot('color', 'secondary')
@slot('body', '<small>Asignar asignaturas para <strong>' . $plan->nombre . '</strong></small>')
@endcomponent
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form class="form-sample form-submit" action="{{ route('planes.asignaturas',$plan->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="col-md-12 mb-3">
            <select  size="10" class="form-control select2 {{ $errors->has('asignaturas_ids') ? 'is-invalid' : '' }} " data-dropdown-css-class="select2-green" style="width: 100%;" multiple="multiple" id="asignaturas_ids" name="asignaturas_ids[]" required>
            @foreach  ($asignaturas as $a)
              <option {{ $a->selected ? 'selected' : '' }} value="{{ $a->id }}">[{{ $a->semestre }}] {{ $a->toString() }}</option>
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

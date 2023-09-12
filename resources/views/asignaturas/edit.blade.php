@extends('layouts.app')
@section('content')

@component('components.button._back')
@slot('route', route('asignaturas.index'))
@slot('color', 'secondary')
@slot('body', '<small>Editar - <strong>' . $a->nombre . '</strong></small>')
@endcomponent
<div class="row">
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form class="form-sample form-submit" action="{{ route('asignaturas.update',$a->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="programa" class="form-label">Programa<small class="text-danger">*</small></label>
            <input type="text" class="form-control" id="programa" name="programa" value="{{ $a->programa }}" required>
          </div>
          <div class="mb-3">
            <label for="semestre" class="form-label">Semestre<small class="text-danger">*</small></label>
            <select class="form-select form-select" name="semestre" id="semestre">
              @for ($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}" {{ $a->semestre == $i ? 'selected' : '' }}>{{ $i }}</option>
              @endfor
            </select>
          </div>
          <div class="mb-3">
            <label for="sigla" class="form-label">Código<small class="text-danger">*</small></label>
            <input type="text" class="form-control" id="sigla" name="sigla" value="{{ $a->sigla }}" required>
          </div>

          <div class="mb-3">
              <label for="nombre" class="form-label">Descripción<small class="text-danger">*</small></label>
              <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $a->nombre }}" required>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

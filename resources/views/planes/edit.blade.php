@extends('layouts.app')
@section('content')

@component('components.button._back')
@slot('route', route('planes.show', $plan->id))
@slot('color', 'secondary')
@slot('body', '<small>Disponibilidad Horaria - <strong>' . $plan->nombre . '</strong>')
@endcomponent
@include('planes._tabs_gestion_edit')
<div class="row">
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <div class="card-body">
        {{-- <h4 class="card-title">Editar</h4> --}}
        <form class="form-sample form-submit" action="{{ route('planes.update',$plan->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $plan->nombre }}" required>
          </div>
          <div class="mb-3">
              <label for="sigla" class="form-label">Descripcion</label>
              <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $plan->descripcion }}">
          </div>

          {{-- <div class="mb-3">
            <label for="" class="form-label">Estado</label>
            <select class="form-select" name="" id="">
              <option value="">New Delhi</option>
              <option value="">Istanbul</option>
              <option value="">Jakarta</option>
            </select>
          </div> --}}
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

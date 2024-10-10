
@extends('layouts.app')
@section('content')


<div class="row g-3 mb-4 align-items-center justify-content-between">
  @component('components.button._back')
    @slot('body', 'Espacio <strong>' . $e->nombre .'</strong>')
    @slot('route', route('admin.espacio.index'))
  @endcomponent
</div>

<div class="row">
  <div class="col-md-3">
    @include('admin.espacio._card_info')
  </div>
  <div class="col">
    @include('admin.espacio._navs')

    <div class="app-card app-card-settings shadow-sm p-4">

      <div class="app-card-body">
        <form class="settings-form row" action="{{ route('admin.espacio.update', $e->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3 col-md-12">
            <label for="nombre" class="form-label">Nombre espacio<small class="text-danger">*</small></label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $e->nombre }}" required>
          </div>
          <div class="mb-3 col-md-12">
            <label for="nombre" class="form-label">Sigla<small class="text-danger">*</small></label>
            <input type="text" class="form-control" id="sigla" name="sigla" value="{{ $e->sigla }}" placeholder="DYP2002" required>
          </div>
          {{-- <div class="mb-3 col-md-6">
            <label for="nombre" class="form-label">Periodo<small class="text-danger">*</small></label>
            <select class="form-select" name="periodo" id="periodo">
              <option value="12024">01-2024</option>
            </select>
          </div> --}}

          <div class="mb-3 col-md-12">
            <label for="institucion" class="form-label">Institución</label>
            <input type="text" class="form-control" id="institucion" name="institucion" value="{{ $e->institucion }}" required>
          </div>

          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" id="descripcion" name="descripcion" rows="3">{{ $e->descripcion }}</textarea>
          </div>

          <div class="form-group">
            <label class="col-form-label" for="hf-rut">Imagen <small>(Opcional)</small></label>
            <div class="input-group">
              <input type="file" class="form-control" name="image" accept="image/*" onchange="preview(this)" />
              <br>
            </div>
          </div>
          <div class="col text-center">
            <img src="{{ asset($e->getPhoto()) }}"  class='Responsive image img-thumbnail'  width='200px' height='200px' alt="">
          </div>
          <div class="form-group text-center mb-3">
            <div id="preview"></div>
          </div>
          <div class="text-end">
            <button type="submit" class="btn app-btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


{{-- $table->string('periodo'); // "202302"
$table->string('nombre');
$table->string('descripcion')->nullable();
$table->string('sigla')->nullable();
$table->string('institucion')->nullable();
$table->string('codigo_unirse')->unique();
$table->string('codigo_registro')->unique();
$table->integer('registro_activo')->default(true);
$table->json('info')->nullable();
$table->json('web')->nullable();
$table->foreignId('id_usuario')->references('id')->on('usuario');
$table->integer('activo')->default(true); --}}

{{-- <div class="card text-start"> --}}
  {{-- <div class="card-body"> --}}

@endsection
@push('js')
  <script src="{{ asset('vendors/bemtorres/validate-run.js') }}"></script>
  <script src="{{ asset('vendors/bemtorres/preview.js') }}"></script>

@endpush

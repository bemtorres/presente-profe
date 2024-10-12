@extends('layouts.webapp_docente.app')
@section('content')


<div class="row g-3 mb-4 align-items-center justify-content-between">
  @component('components.button._back')
    @slot('body', "Espacio <strong> $e->nombre </strong>")
    @slot('route', route('webappdocente.index'))
  @endcomponent
</div>

<div class="row">
  <div class="col-md-2">
    @include('webapp_docente.espacio._card_info')
  </div>
  <div class="col">
    @include('webapp_docente.espacio._navs')
    <div class="card text-start">
      <div class="card-body">
        {{-- <h4 class="card-title">Espacio <strong>{{ $e->nombre }}</strong></h4> --}}
        {{-- <p class="card-text">Text</p> --}}
        <div class="row g-4 mb-4">
          <div class="col-10">
            <div class="modal-body">
              <form class="settings-form row" action="{{ route('webappdocente.espacios.update',$e->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 col-md-6">
                  <label for="nombre" class="form-label">Nombre espacio<small class="text-danger">*</small></label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $e->nombre }}" required>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="nombre" class="form-label">Sigla<small class="text-danger">*</small></label>
                  <input type="text" class="form-control" id="sigla" name="sigla" value="{{ $e->sigla }}"placeholder="DYP2002" required>
                </div>

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
                    <img src="{{ asset($e->getPhoto()) }}"  class='Responsive image img-thumbnail'  width='200px' height='200px' alt="">
                    <input type="file" class="form-control" name="image" accept="image/*" onchange="preview(this)" />
                    <br>
                  </div>
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
    </div>
  </div>
</div>
</div>
@endsection

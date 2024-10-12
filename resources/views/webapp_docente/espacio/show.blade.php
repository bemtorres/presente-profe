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
          <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
              <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Registrados</h4>
                <div class="stats-figure">{{ $e->matriculas->count() }}</div>
              </div>
              <a class="app-card-link-mask" href="#"></a>
            </div>
          </div>
          <h1 class="app-page-title">
            <button class="ms-2 px-2 btn-sm btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#modalUnirse">
              Nueva clase
            </button>
          </h1>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection




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
    <div class="card text-start">
      <div class="card-body">
        <h4 class="card-title">Espacio <strong>{{ $e->nombre }}</strong></h4>
        {{-- <p class="card-text">Text</p> --}}

        <div class="row g-4 mb-4">
          <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
              <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Registrados</h4>
                <div class="stats-figure">{{ $e->matriculas->count() }}</div>
                <div class="stats-meta text-success">
                  {{-- <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"></path>
                  </svg> 20%</div> --}}
                </div>
              </div>
              <a class="app-card-link-mask" href="#"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

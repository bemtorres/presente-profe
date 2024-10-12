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
          <h1 class="app-page-title">
            <button class="ms-2 px-2 btn-sm btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#modalAnuncio">
              Nueva anuncio
            </button>
          </h1>

        </div>


        <div class="table-responsive ">
          <table class="table app-table-hover table-sm mb-0 text-left">
            <thead>
              <tr>
                <th class="cell">Titulo</th>
                <th class="cell">Mensaje</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($e->anuncios as $a)
                <tr>
                  <td class="cell">{{ $a->titulo }}</td>
                  <td>{{ $a->mensaje }}</td>
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
@include('webapp_docente.espacio._modal_anuncio')
@endsection




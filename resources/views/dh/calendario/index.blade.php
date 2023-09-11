@extends('layouts.app')
@push('css')

@endpush
@section('content')
@component('components.button._back')
@slot('route', route('home.index'))
@slot('color', 'secondary')
@slot('body', '<small>Disponibilidad Horaria - <strong>' . $plan->nombre . '</strong></small>')
@endcomponent

@if ($plan->estado == 3)
<div class="row">
  <div class="col-md-12">
    <div class="alert alert-danger" role="alert">
      <p class="mb-0">📣 La edición de <strong>disponibilidad horaria</strong> ha sido desactivada.</p>
    </div>
  </div>
</div>
@endif
@include('dh._tabs')
<div class="card shadow mb-4">
  <div class="row p-3">
    {{-- <div class="col-md-4">
      <div class="card">
        <img src="{{ asset('app/teamwork-3213924_640.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $plan->nombre }}</h5>
          <p class="card-text">{{ $plan->descripcion }}</p>

          <ul class="list-group list-group-flush">
            <li class="list-group-item d-grid">
                <a name="" id="" class="btn btn-outline-success btn-sm" href="{{ route('disponibilidad.asignaturas',$plan->id) }}">📖 Mis asignaturas</a>
            </li>
            <li class="list-group-item d-grid">
              <a name="" id="" class="btn btn-outline-warning btn-sm text-dark" href="#">📅 Calendario</a>
            </li>
          </ul>
        </div>
      </div>
    </div> --}}

    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <p class="card-text">📰 <strong>Noticias</strong></p>


          <calendario ></calendario>

          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              falta crear calendario
            </li>
            <li class="list-group-item">
              falta crear asignaturas
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')

@endpush

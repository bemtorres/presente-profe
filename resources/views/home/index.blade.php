@extends('layouts.app')
@section('css')

@endsection
@section('content')
@component('components.button._back')
  @slot('body','<strong>Disponibilidad Horaria</strong>')
@endcomponent
<div class="row">
  @foreach ($planes_asociados as $pa)
    @continue($pa->plan->estado == 1 || $pa->plan->estado == 10)

  <div class="col-md-4 mb-3">
    <div class="card shadow" onclick="window.location='{{ route('disponibilidad.show',$pa->plan->id) }}';">
      {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
        Disponibilidad horario pendiente
      </span> --}}
      <img src="{{ asset('app/pexels-anete-lusina-5239919.jpg') }}" class="card-img-top" alt="...">
      <div class="card-body">

        @if ($pa->plan->estado == 3)
          <div class="card-img-overlay py-0 px-1">
            <div class="card-title justify-content-between">
              <div class="text-center py-5 my-5">
                <h4><span class="badge bg-dark">Finalizado</span></h4>
              </div>
            </div>
          </div>
        @endif

        <h5 class="card-title">{{ $pa->plan->nombre }}</h5>
        <p class="card-text">{{ $pa->plan->descripcion }}</p>
        <div class="d-grid">

          @if ($pa->plan->estado == 2)
            <a href="{{ route('disponibilidad.show',$pa->plan->id) }}" class="btn btn-primary">Ver</a>
          @else
            <a href="{{ route('disponibilidad.show',$pa->plan->id) }}" class="btn btn-danger">Finalizado</a>
          @endif

        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection

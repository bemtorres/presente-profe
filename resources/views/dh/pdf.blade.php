@extends('layouts.app')
@push('css')

@endpush
@section('content')
@component('components.button._back')
@slot('route', route('disponibilidad.show',$plan->id))
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
{{-- @include('dh._tabs') --}}
{{-- <div class="card shadow mb-4">
  <div class="row p-3">
    <div class="col-md-4">
      <div class="card">
        <img src="{{ asset('app/teamwork-3213924_640.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $plan->nombre }}</h5>
          <p class="card-text">{{ $plan->descripcion }}</p>

          <ul class="list-group list-group-flush">
            <li class="list-group-item d-grid">
              <a class="btn btn-outline-success btn-sm" href="{{ route('disponibilidad.asignaturas',$plan->id) }}">📖 Mis asignaturas</a>
            </li>
            <li class="list-group-item d-grid">
              <a class="btn btn-outline-warning btn-sm text-dark" href="{{ route('disponibilidad.show.pdf',$plan->id) }}">📅 Calendario</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div> --}}
<div class="row justify-content-center">
  {{-- <div class="col-md-12 text-center mb-3">
    <a href="{{ route('pdf.diponibilidad', [$plan->id, $asociado->id]) }}" class="btn btn-danger btn-sm text-white"><i class="fa fa-file-pdf me-2"></i><strong>VER PDF</strong></a>
  </div> --}}
  <div class="col">
    <div class="card">
      <div class="card-body">
        <iframe src="{{ route('pdf.diponibilidad.personal',[$plan->id, $asociado->id]) }}" style="width:100%; height:700px;" frameborder="0" ></iframe>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')

@endpush

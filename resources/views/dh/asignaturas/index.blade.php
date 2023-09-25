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
<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                {{-- <th>id</th> --}}
                <th>Programa</th>
                <th>Semestre</th>
                <th>Cod. Asig</th>
                <th>Descripcion</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($plan->detalle_plan as $dp)
              @php
                  $a = $dp->asignatura;
              @endphp
              <tr>
                {{-- <td>{{ $a->id }}</td> --}}
                <td>{{ $a->programa }}</td>
                <td>{{ $a->semestre }}</td>
                <td>{{ $a->sigla }}</td>
                <td>{{ $a->nombre }}</td>
                <td>
                  @if ($a->getFile())
                    <a href="{{ route('disponibilidad.asignaturasPDF', [$plan->id,$a->id]) }}" class="btn btn-sm btn-danger me-2"><strong>PDF</strong></a>
                  @endif
                  @if ($a->getUrl())
                    <a href="{{ $a->getUrl() }}" target="_blank" class="btn btn-sm btn-dark me-2"><strong>LINK</strong></a>
                  @endif
                </td>
                {{-- <td><a href="{{ route('admin.usuario.show',$u->id) }}">{{ $u->correo }}</a></td> --}}
                {{-- <td>{{ $u->nombre_completo() }}</td> --}}
                {{-- <td>{{ $u->team->nombre ?? '' }}</td> --}}
                {{-- <td> --}}
                  {{-- <img src="{{ asset(current_config()->present()->getImagenCoin()) }}" width="20px" alt=""> --}}
                  {{-- {{ $u->getCredito() }} --}}
                {{-- </td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')

@endpush

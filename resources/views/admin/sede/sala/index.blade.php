@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="container-fluid">
  <div class="row">
    @component('components.button._back')
      @slot('route', route('sedes.index'))
      @slot('color', 'secondary')
      @slot('body', 'Sede - ' . $s->nombre)
    @endcomponent

    <div class="col-md-12">
      @include('admin.sede._tabs_sede')
      <div class="card shadow mb-4">
        <div class="card-body">

          <sala-view
          :horarios=@json($horarios)
          :editable="true"
          :salas="{{ json_encode($salas)}}"
          :semestre=@json($semestre)
          :semanasdetall="{{ json_encode($array_semestre) }}"
          post-buscar-calendario="{{ route('api.backend.calendario.buscar') }}"
          post-store-calendario="{{ route('api.backend.calendario.store') }}"

          ></sala-view>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

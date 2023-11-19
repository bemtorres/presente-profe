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
        <div class="card-body row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Title</h4>
                <p class="card-text">Text</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Title</h4>
                <p class="card-text">Text</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

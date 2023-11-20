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
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <form class="form-sample form-submit" action="" method="POST">
                  @csrf
                  <div class="row mb-3">
                    <div class="col-md-12 mb-3">
                      <div class="form-group row">
                        <label class="col-sm-12" for="correo">Correo <small class="text-danger">*</small></label>
                        <div class="col-sm-12">
                          <input type="email" class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" name="correo" id="correo" value="{{ old('correo') }}" required/>
                          {!! $errors->first('correo', ' <small id="inputPassword" class="form-text text-danger">:message</small>') !!}
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Correos Copia</h4>
                <p>Cuando se envie un correo los siguientes correos tendran copia</p>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Correo</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($s->getInfoCorreo() as $c)
                        <tr>
                          <td>{{ $c['correo'] }}</td>
                          <td>
                            @if ($c['status'])
                              <span class="badge rounded-pill bg-success">Activado</span>
                            @else
                              <span class="badge rounded-pill bg-danger">Desactivado</span>
                            @endif
                          </td>
                          <td>
                            <form class="form-submit" action="" method="POST">
                              @csrf
                              @method('PUT')
                              <input type="text" name="correo" value="{{ $c['correo'] }}" hidden>
                              @if ($c['status'])
                                <button type="submit" class="btn btn-warning btn-sm">Desactivar</button>
                              @else
                                <button type="submit" class="btn btn-success btn-sm">Activar</button>
                              @endif
                            </form>
                          </td>
                          <td>
                            <form class="form-submit" action="" method="POST">
                              @csrf
                              @method('DELETE')
                              <input type="text" name="correo" value="{{ $c['correo'] }}" hidden>
                              <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                          </td>
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
    </div>
  </div>
</div>
@endsection

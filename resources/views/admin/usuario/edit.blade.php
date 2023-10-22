
@extends('layouts.app')
@push('css')
  <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endpush
@section('content')
<div class="container-fluid">
  <div class="row">
    @component('components.button._back')
      @slot('route', route('usuarios.show', $u->id))
      @slot('color', 'secondary')
      @slot('body', 'Editar ' . $u->nombre_completo())
    @endcomponent
    <div class="col-md-7">
      <div class="card shadow mb-3">
        <div class="card-body">
          <form class="form-sample form-submit" action="{{ route('usuarios.update',$u->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-md-12 mb-3">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-md">
                  <img class="avatar-img" src="{{ $u->getImg() }}" alt="">
                </div>
                <div class="ms-2">
                  <span class="h6 mt-2 mt-sm-0">{{ $u->nombre_completo() }}</span>
                  <p class="small m-0">{{ $u->correo }}</p>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12 mb-3">
                <div class="form-group row">
                  <label class="col-sm-12" for="correo">Correo <small class="text-danger">*</small></label>
                  <div class="col-sm-12">
                    <input type="email" class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" name="correo" id="correo" value="{{ $u->correo }}"/>
                    {!! $errors->first('correo', ' <small id="inputPassword" class="form-text text-danger">:message</small>') !!}
                  </div>
                </div>
              </div>

              <div class="col-md-12 mb-3">
                <div class="form-group row">
                  <label class="col-sm-12" for="nombre">Nombre <small class="text-danger">*</small></label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $u->nombre }}" required/>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <div class="form-group row">
                  <label class="col-sm-12" for="apellido_p">Apellido Paterno<small class="text-danger">*</small></label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="apellido_p" id="apellido_p" value="{{ $u->apellido_paterno }}" required/>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <div class="form-group row">
                  <label class="col-sm-12" for="apellido_m">Apellido Materno <small class="text-danger">*</small></label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="apellido_m" id="apellido_m" value="{{ $u->apellido_materno }}" required/>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <label for="admin">Administrador<small class="text-danger">*</small></label>
                <select class="form-control" id="admin" name="admin">
                  <option value="1" {{ $u->tipo_usuario == 1 ? 'selected' : '' }}>Si</option>
                  <option value="2" {{ $u->tipo_usuario == 2 ? 'selected' : '' }}>No</option>
                </select>
              </div>
            </div>
            <div class="form-group d-flex justify-content-end">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card shadow mb-3">
        <div class="card-body">
          <form class="form-sample form-submit" action="{{ route('usuarios.update',$u->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="form-group row">
                  <label class="col-sm-12" for="pass">Cambiar contraseña <small class="text-danger">*</small></label>
                  <div class="col-sm-12">
                    <input type="password" class="form-control" name="pass" id="pass" value="" required/>
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
  </div>
</div>

@endsection
@push('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
@endpush

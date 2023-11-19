@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="container-fluid">
  <div class="row">
    @component('components.button._back')
      @slot('route', route('usuarios.index'))
      @slot('color', 'secondary')
      @slot('body', 'Perfil - ' . $u->nombre_completo())
    @endcomponent

    <div class="col-md-12">
      @include('admin.usuario._tabs_usuario')
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-3 mb-4">
              <div class="card mb-4">
                <div class="card-body">
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
                </div>
              </div>
            </div>
            <div class="col mb-4">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table
                    table-hover
                    table-bordered
                    align-middle">
                      <thead>
                        <tr>
                          <th>Sede</th>
                          <th></th>
                          <th class="text-center">Recepción de solicitudes</th>
                          <th>Copia correo</th>
                          <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          @foreach ($sedes as $s)
                            <tr>
                              <td>
                                <div class="d-flex align-items-center">
                                  <div class="">
                                    <img src="{{ $s->getImg() }}" width="50" alt="">
                                  </div>
                                  <div class="ms-2">
                                    <span class="h6 mt-2 mt-sm-0">{{ $s->nombre }}</span>
                                    @if ($s->checked)
                                      <i class="ms-2 fa fa-circle-check text-success"></i>
                                    @else
                                      <i class="ms-2 fa fa-times text-danger"></i>
                                    @endif
                                  </div>
                                </div>
                              </td>
                              <td>
                                @if (!$s->activo)
                                  <span class="badge bg-dark">Fuera de servicio</span>
                                @endif
                              </td>
                              <td class="text-center">
                                <form class="form-submit" action="{{ route('usuarios.sedes', $u->id) }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <input type="hidden" name="sede_id" value="{{ $s->id }}">
                                  @if ($s->checked)
                                    <button type="submit" class="btn btn-success btn-sm">Activado</button>
                                  @else
                                    <button type="submit" class="btn btn-danger btn-sm">Activar</button>
                                  @endif
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
</div>
@endsection

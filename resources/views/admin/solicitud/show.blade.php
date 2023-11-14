@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="container-fluid">
  @component('components.button._back')
    @slot('route', route('solicitud.index'))
    @slot('color', 'dark')
    @slot('body', 'Solicitud de sala #' . $s->id)
  @endcomponent
  <div class="card shadow mb-4">
    <div class="card-body row">
      <div class="col-md-4">
        <div class="card text-start">
          <div class="card-body">
            <div class="row">
              <div class="col-2">
                <div class="avatar avatar-md">
                  <img class="avatar-img" src="{{ $s->usuario->getImg() }}" alt="user@email.com">
                  <span class="avatar-status bg-success"></span>
                </div>
              </div>
              <div class="col">
                <div>{{ $s->usuario->nombre_completo() }}</div>
                <div class="small text-medium-emphasis">{{ $s->usuario->correo }}</div>
              </div>
            </div>
            <div class="my-3 text-center">
              <table class="table">
                <tbody>
                  <tr>
                    <td scope="row">{{ $s->sede->nombre }}</td>
                  </tr>
                  <tr>
                    <td>{{ $s->sala->nombre }}</td>
                  </tr>
                  <tr>
                    <td>{{ $s->sem->getInfo() ?? '' }}</td>
                  </tr>
                  <tr>
                    @if ($s->motivo == 100)
                      <em>{{ $s->comentario }}</em>
                    @else
                      <td><h5><span class="badge rounded-pill text-bg-info">{{ $s->getMotivo() }}</span></h5></td>
                    @endif
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="card mt-3 text-start">
          <div class="card-body">
            @include('admin.solicitud._estado')

            {{-- @if ($s->estado == 1 || $s->estado == 2) --}}
            <div class="d-grid">
              <button type="button" class="btn btn-warning" data-coreui-toggle="modal" data-coreui-target="#estadoModal">
                Validar solcitud
              </button>
            </div>
            {{-- @endif --}}

            @if ($s->revisor)
            <div class="d-grid my-3 text-center">
              Revisado por: {{ $s->revisor->nombre_completo() ?? '' }}
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-start">
          <div class="card-body">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-coreui-toggle="tab" data-coreui-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                  Calendario
                </button>
                <button class="nav-link" id="nav-profile-tab" data-coreui-toggle="tab" data-coreui-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                  Detalle
                </button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <div class="card text-start">
                  <div class="card-body">
                    <calendario-view
                      :horarios=@json($horarios)
                      :solicitud="{{ json_encode($s)}}"
                      :semestre=@json($semestre)
                      :semanasdetall="{{ json_encode($array_semestre) }}"
                      post-buscar-calendario="{{ route('api.backend.calendario.buscar.all') }}"
                    >
                    </calendario-view>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <div class="card text-left">
                  <img class="card-img-top" src="holder.js/100px180/" alt="">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-sm table-striped">
                        <tbody>
                          <tr>
                            <td colspan="2" class="text-center bg-dark text-white">
                              <strong>MÓDULOS SOLICITADOS</strong>
                            </td>
                          </tr>
                          @foreach ($data_registros as $dia => $data)
                          <tr class="">
                            <td>
                                <strong>{{ $data['fecha_text'] }}</strong>
                            </td>
                            <td>
                              @foreach ($data['modulos'] as $modulo)
                                <span class="badge rounded-pill text-bg-primary mx-2">{{ $modulo['horario'] }}</span>
                              @endforeach
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
</div>
<!-- Modal -->
<div class="modal fade" id="estadoModal" tabindex="-1" aria-labelledby="estadoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar estado de solicitud</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-submit" action="{{ route('solicitud.update', $s->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="d-grid gap-3">
            <button type="submit" class="btn btn-success btn-lg" value="aprobar" name="btnSolicitud">Aceptar solicitud</button>
          </div>
        </form>
        <form class="form-submit" action="{{ route('solicitud.update.rechazar', $s->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="d-grid gap-3 mt-3">
            <button type="submit" class="btn btn-danger btn-lg" value="rechazar" name="btnSolicitud">Rechazar solicitud</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
@endpush

@php
  use Carbon\Carbon;

  $now = new \DateTime();
  $fecha = $now->format('Y-m-d');
  $hora = date('H:i');

  $fechaHoraActual = Carbon::now()->format('Y-m-d\TH:i');
@endphp
@extends('layouts.webapp_alumno.app')
@push('css')
<style>
  #qr-reader {
    width: 100%;
    margin: 0 auto;
  }
  #qr-reader-results {
    margin-top: 20px;
  }
</style>
@endpush
@section('content')

<h1 class="app-page-title">
  Inscritos
  <button class="ms-2 px-2 btn-sm btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#modalUnirse">
    Matricularse a un curso
  </button>


  <button class="ms-2 px-2 btn-sm btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#modalQr">
    Registro rápido por QR
  </button>
</h1>
<div class="row g-4">
  @foreach ($matriculas as $m)
  @php
    $e = $m->espacio;
    $u = $e->usuario;
  @endphp
    <div class="col-12 col-md-4 col-xl-3 col-xxl-2">
      <div class="app-card app-card-doc shadow h-100">
        <div class="app-card-thumb-holder p-3">
          <div class="app-card-thumb">
            <img class="thumb-image" src="{{ asset($e->getPhoto()) }}" alt="">
          </div>
          {{-- <span class="badge bg-success">NEW</span> --}}
          {{-- <a class="app-card-link-mask" href="#file-link"></a> --}}
        </div>
        <div class="app-card-body p-3 has-card-actions">

          <h3 class="app-doc-title  mb-1">{{ $e->nombre }}</h3>
          <div class="app-doc-meta">
            <ul class="list-unstyled mb-0">
              <li><span class="text-muted">Sección:</span>{{ $e->sigla }}</li>
              <li><span class="text-muted">Docente:</span> {{ $u->nombre_completo() }}</li>
            </ul>
          </div>

          <div class="d-grid gap-2 mt-2">
            {{-- <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalPresente">
              Pendiente
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
              </svg>
            </button> --}}

            {{-- <button class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#modalPresente">
              Validado
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
              </svg>
            </button> --}}
          </div>

          <div class="app-card-actions">
            <div class="dropdown">
              <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical"
                  fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                </svg>
              </div>
              <ul class="dropdown-menu">
                {{-- <li>
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPresente">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                      <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                    </svg>
                    ¡Presente!
                  </button>
                </li> --}}
                {{-- <li>
                  <a class="dropdown-item" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hexagon me-2" viewBox="0 0 16 16">
                      <path d="M14 4.577v6.846L8 15l-6-3.577V4.577L8 1zM8.5.134a1 1 0 0 0-1 0l-6 3.577a1 1 0 0 0-.5.866v6.846a1 1 0 0 0 .5.866l6 3.577a1 1 0 0 0 1 0l6-3.577a1 1 0 0 0 .5-.866V4.577a1 1 0 0 0-.5-.866z"/>
                    </svg>
                    Evaluaciones
                  </a>
                </li> --}}
                <li>
                  <a class="dropdown-item" href="{{ route('webappalumno.historial', $m->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history me-2" viewBox="0 0 16 16">
                      <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                      <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                      <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                    </svg>
                    Historial
                  </a>
                </li>
                <li>
                  <button class="dropdown-item" data-matricula="{{ $m->id }}" data-bs-toggle="modal" data-bs-target="#modalInasistencia">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag me-2" viewBox="0 0 16 16">
                      <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z"/>
                    </svg>
                    Reportar inasistencia
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="modal fade" id="modalInasistencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Reporte de inasistencia</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
        <form action="{{ route('webappalumno.reporte.store') }}" method="post">
          @csrf
          <div class="text-center">
            <small class="text-success">Este mensaje lo verá solo el docente</small>
          </div>

          <input type="text" hidden id="modal_id_matricula" class="form-control" name="modal_id_matricula" required>

          <div class="mb-3 col-md-12">
            <label for="fecha" class="form-label">Fecha<small class="text-danger">*</small></label>
            <input type="date" id="modal_fecha" class="form-control" name="modal_fecha" value="{{ $fecha }}" required>
          </div>
          <div class="mb-3">
            <label for="modal_mensaje" class="form-label">Mensaje<small class="text-danger">*</small></label>
            <textarea class="form-control" name="modal_mensaje" id="modal_mensaje" rows="5" style="height: 300px;" required></textarea>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success text-white" type="button">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalQr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> --}}
      <div class="modal-body row">
        <form action="{{ route('webappalumno.registro.store') }}" method="post">
          @csrf
          <!-- Div donde se mostrará la cámara -->
          <div class="col-12 text-center">
            <div id="qr-reader"></div>
          </div>
          <!-- Resultado del código QR escaneado -->
          <div id="qr-reader-results">Resultado: <span id="result"></span></div>
          <input type="text" id="codigoQR" name="codigoQR" hidden readonly>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-warning text-white" id="btn_presente" hidden type="button">Presente</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@include('webapp_alumno._modal_presente')
@include('webapp_alumno._modal_unirse')
@include('webapp_alumno._modal_perfil')
@endsection
@push('js')
<script src="{{ asset('vendors/html5-qrcode.min.js') }}"></script>
<script>

  // btn_presente

  // Función para manejar el escaneo del QR
  function onScanSuccess(qrMessage) {
    // Mostrar el resultado en el div
    document.getElementById('result').innerText = qrMessage;
    // console.log('Código QR escaneado: ', qrMessage);
    document.getElementById('codigoQR').value = qrMessage;
    // click boton
    document.getElementById('btn_presente').click();
  }

  function onScanError(errorMessage) {
    // Puedes manejar errores durante el escaneo
    console.log('Error de escaneo: ', errorMessage);
  }

  // Inicialización del lector de QR
  var html5QrCode = new Html5Qrcode("qr-reader");

  // Configuración de la cámara y escaneo
  function startQrScanner() {
    html5QrCode.start(
      { facingMode: "environment" },  // Usa la cámara trasera
      {
        fps: 10,   // Cuántos frames por segundo para el escaneo
        qrbox: { width: 250, height: 250 }  // Caja de escaneo, ajusta si es necesario
      },
      onScanSuccess,
      onScanError
    ).catch(err => {
      console.log("Error al acceder a la cámara: ", err);
    });
  }

  // Función para verificar si la cámara está correctamente inicializada
  function checkCamera() {
    Html5Qrcode.getCameras().then(cameras => {
      if (cameras && cameras.length) {
        startQrScanner();  // Inicia el escaneo si hay cámaras disponibles
      } else {
        console.log("No se encontraron cámaras.");
      }
    }).catch(err => {
      console.log("Error al obtener cámaras: ", err);
    });
  }

  // Verifica cámaras y empieza el escaneo
  checkCamera();
</script>
<script>

var modalInasistencia = document.getElementById('modalInasistencia');
modalInasistencia.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  var matricula = button.getAttribute('data-matricula');
  document.getElementById('modal_id_matricula').value = matricula;
});
</script>
@endpush

@extends('layouts.app.app')
@push('css')
    {{-- <link href="{{ asset('vendors/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
    <style>
        body {
            background: #04243c;
        }

        /* Estilo de los elementos de la lista seleccionada */
        .list-group-item-selected {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        /* Estilo para ocultar la lista inicialmente */
        #lista {
            display: none;
        }

        .cursor {
            cursor: pointer;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<nav class="navbar navbar-expand-md bg-dark bg-cd-primary p-2 mb-md-2 sticky-top border-bottom border-5 border-warning" data-bs-theme="dark">
  <div class="container justify-content-center">
    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
      <img class="bi me-2" src="{{ asset('template/img/comparte-logo.svg') }}" width="70" height="70">
    </a>
  </div>
</nav>

<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="card mb-4">
              <div class="card-body">
                <buscar-usuario post-buscar='{{ route('api.backend.usuario.buscar') }}'></buscar-usuario>
              </div>
              <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                  Open Modal
                </button>

                <ul class="list-group cursor">
                  <li class="list-group-item d-flex justify-content-between align-items-center" id="mostrarLista">
                    <div class="d-flex align-items-center">
                      <div class="ms-2">
                        <span class="badge rounded-pill text-bg-primary">SEDE SAN JOAQUÍN</span>
                        <p class="h6 mt-2 mt-sm-0">SALA 304</p>
                        <p class="small m-0">PISO 2</p>

                        <p>Capacidad: 30 personas</p>
                        <p>SEMANA 5 - 25-septiembre / 30-septiembre</p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <p class="card-text">🏦 <strong>SEDE</strong></p>
                        <select name="" id="" class="form-select js-basic-single">
                            @foreach ($sedes as $s)
                                <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <p class="card-text">📖 <strong>Selecione la sala</strong></p>
                        <select name="" id="" class="form-select js-basic-single">
                            @for ($i = 100; $i <= 400; $i++)
                                @php
                                    $i = $i + 16;
                                @endphp
                                <option value="{{ $i }}">Sala {{ $i }} </option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="semanaSelect">🚪 <strong>Selecciona una semana</strong></label>
                        <select class="form-select" id="semanaSelect">
                            <option value="1">SEMANA 1 / 07-08-2023 - 13-08-2023</option>
                            <option value="2">SEMANA 2 / 14-08-2023 - 20-08-2023</option>
                            <option value="3">SEMANA 3 / 21-08-2023 - 27-08-2023</option>
                            <option value="4">SEMANA 4 / 28-08-2023 - 03-09-2023</option>
                            <option value="5">SEMANA 5 / 04-09-2023 - 10-09-2023</option>
                            <option value="6">SEMANA 6 / 11-09-2023 - 17-09-2023</option>
                            <option value="7">SEMANA 7 / 18-09-2023 - 24-09-2023</option>
                            <option value="8">SEMANA 8 / 25-09-2023 - 01-10-2023</option>
                            <option value="9">SEMANA 9 / 02-10-2023 - 08-10-2023</option>
                            <option value="10">SEMANA 10 / 09-10-2023 - 15-10-2023</option>
                            <option value="11">SEMANA 11 / 16-10-2023 - 22-10-2023</option>
                            <option value="12">SEMANA 12 / 23-10-2023 - 29-10-2023</option>
                            <option value="13">SEMANA 13 / 30-10-2023 - 05-11-2023</option>
                            <option value="14">SEMANA 14 / 06-11-2023 - 12-11-2023</option>
                            <option value="15">SEMANA 15 / 13-11-2023 - 19-11-2023</option>
                            <option value="16">SEMANA 16 / 20-11-2023 - 26-11-2023</option>
                            <option value="17">SEMANA 17 / 27-11-2023 - 03-12-2023</option>
                            <option value="18">SEMANA 18 / 04-12-2023 - 10-12-2023</option>
                        </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <p class="card-text d-flex justify-content-between align-items-center">
                  <span>📅<strong>Seleccione el horario que desee registrar</strong></span>
                </p>
                <calendariocomparte
                  :horarios=@json($horarios)
                  :myhorario=@json($my_horario)
                  :editable="true"
                  :alertmensaje="alertmensaje"></calendariocomparte>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-basic-single').select2();
        });

        function mainPushData(data) {
            console.log(data);
        }

        function alertmensaje(data) {
            console.log(data);
            // alert(data);
        }


        const exampleModal = document.getElementById('exampleModal')
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                // const recipient = button.getAttribute('data-bs-whatever')
                const recipient = "NICE"

                // If necessary, you could initiate an Ajax request here
                // and then do the updating in a callback.

                // Update the modal's content.
                const modalTitle = exampleModal.querySelector('.modal-title')
                const modalBodyInput = exampleModal.querySelector('.modal-body input')

                modalTitle.textContent = `New message to ${recipient}`
                modalBodyInput.value = recipient
            })
        }
    </script>
@endpush

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
<nav class="navbar navbar-expand-md bg-dark bg-cd-primary p-2 mb-3 sticky-top border-bottom border-5 border-warning" data-bs-theme="dark">
  <div class="container justify-content-center">
    <a href="/app" class="d-flex align-items-center link-body-emphasis text-decoration-none">
      <img class="bi me-2" src="{{ asset('template/img/comparte-logo.svg') }}" width="50" height="50">
    </a>
  </div>
</nav>

<div class="row">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                  <p>Busqueda personalizada</p>
                  <div class="mb-3">
                      <p class="card-text">🏦 <strong>SEDE</strong></p>
                      <select name="" id="" class="form-select js-basic-single">
                          @foreach ($sedes as $s)
                              <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group mb-3">
                    <p class="card-text">⌚ <strong>Cantidad de horas</strong></p>
                    <select name="" id="" class="form-select">
                        @for ($i = 1; $i <= 3; $i++)
                            <option value="{{ $i }}">{{ $i }} </option>
                        @endfor
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <p class="card-text">⌚ <strong>Dias de la semana</strong></p>
                    <select name="" id="" class="form-select" multiple>
                      <option value="1">LUNES</option>
                      <option value="2">MARTES</option>
                      <option value="3">MIERCOLES</option>
                      <option value="4">JUEVES</option>
                      <option value="5">VIERNES</option>
                      <option value="6">SÁBADO</option>
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

                <div class="table-responsive">
                  <table class="table
                  table-hover
                  align-middle">
                    <thead>
                      <tr>
                        <th>Sala</th>
                        <th>Semana</th>
                        <th>Dia</th>
                        <th>Horario</th>
                        <th></th>
                      </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td scope="row">304</td>
                          <td>LUNES</td>
                          <td>
                            SEMANA 1 / 07-08-2023 - 13-08-2023
                          </td>
                          <td>9.30 - 14.00</td>
                          <td>
                            <button type="button" name="" id="" class="btn btn-success btn-sm">Agendar</button>
                          </td>
                        </tr>
                        <tr>
                          <td scope="row">304</td>
                          <td>LUNES</td>
                          <td>
                            SEMANA 1 / 07-08-2023 - 13-08-2023
                          </td>
                          <td>9.30 - 14.00</td>
                          <td>
                            <button type="button" name="" id="" class="btn btn-success btn-sm">Agendar</button>
                          </td>
                        </tr>
                        <tr>
                          <td scope="row">304</td>
                          <td>LUNES</td>
                          <td>
                            SEMANA 1 / 07-08-2023 - 13-08-2023
                          </td>
                          <td>9.30 - 14.00</td>
                          <td>
                            <button type="button" name="" id="" class="btn btn-success btn-sm">Agendar</button>
                          </td>
                        </tr>
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

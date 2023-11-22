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
                  <div class="alert alert-primary" role="alert">
                    <strong>Busqueda personalizada</strong>
                  </div>
                  <div class="form-group mb-3">
                    <p class="card-text"><strong>Semana</strong></p>
                    <select name="" id="" class="form-select">
                      @foreach ($array_semanas as $semana)
                        <option value="1">Semana {{ $semana['info'] }}</option>

                      @endforeach
                    </select>
                  </div>
                  {{-- <div class="form-group mb-3">
                    <p class="card-text"><strong>Cantidad de horas</strong></p>
                    <div class="row">
                      <div class="col-md-6 row align-items-center">
                        <label class="card-text col-6 text-end">Mín</label>
                        <select name="" id="minSelect" class="col form-select">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} </option>
                            @endfor
                        </select>
                      </div>
                      <div class="col-md-6 row align-items-center">
                        <label class="card-text col-6 text-end">Máx</label>
                        <select name="" id="maxSelect" class="col form-select">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} </option>
                            @endfor
                        </select>
                      </div>
                      <span id="errorSpan" style="color: red;"></span>
                    </div>
                  </div> --}}
                  <div class="form-group mb-3">
                    <p class="card-text"><strong>Cantidad de horas</strong></p>
                    <div class="row justify-content-center align-items-center">
                      @for ($i = 1; $i <= 5; $i++)
                      <div class="col-2">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="check-horas[]" value="" id="check-hora-{{ $i }}">
                          <label class="form-check-label" for="check-hora-{{ $i }}">
                            <strong><small>{{ $i }}</small></strong>
                          </label>
                        </div>
                      </div>
                      @endfor
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <p class="card-text"><strong>Números de módulos</strong></p>
                    <div class="row justify-content-center align-items-center">
                      @for ($i = 1; $i <= 5; $i++)
                      <div class="col-2">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="check-modulos[]" value="" id="check-modulo-{{ $i }}">
                          <label class="form-check-label" for="check-modulo-{{ $i }}">
                            <strong><small>{{ $i }}{{ $i == 1 ? 'hr' : 'hrs' }}</small></strong>
                          </label>
                        </div>
                      </div>
                      @endfor
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <p class="card-text"><strong>Dias de la semana</strong></p>
                    <div class="row text-center justify-content-center align-items-center">
                      @foreach ($days as $kd => $d)
                      <div class="col-4 mb-3">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="check-dias[]" value="" id="check-{{ $kd }}">
                          <label class="form-check-label" for="check-{{ $kd }}">
                            <small>{{ $d }}</small>
                          </label>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                  {{-- <div class="form-group mb-3">
                    <p class="card-text">⌚ <strong>Dias de la semana</strong></p>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="check-lunes" value="" id="checkL">
                      <label class="form-check-label" for="checkL">
                        LUNES
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="check-martes" value="" id="checkM">
                      <label class="form-check-label" for="checkM">
                        MARTES
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="check-miercoles" value="" id="checkX">
                      <label class="form-check-label" for="checkX">
                        MIERCOLES
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="check-jueves" value="" id="checkJ">
                      <label class="form-check-label" for="checkJ">
                        JUEVES
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="check-viernes" value="" id="checkV">
                      <label class="form-check-label" for="checkV">
                        VIERNES
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="check-sabado" value="" id="checkS">
                      <label class="form-check-label" for="checkS">
                        SÁBADO
                      </label>
                    </div>
                  </div> --}}


                  <div class="d-grid">
                    <button type="button" class="btn btn-lg btn-primary">Buscar</button>
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

document.addEventListener('DOMContentLoaded', function () {
    const minSelect = document.getElementById('minSelect');
    const maxSelect = document.getElementById('maxSelect');
    const errorSpan = document.getElementById('errorSpan');

    maxSelect.addEventListener('change', function () {
      const minValue = parseInt(minSelect.value);
      const maxValue = parseInt(maxSelect.value);

      if (minValue > maxValue) {
        errorSpan.textContent = 'El valor mínimo no puede ser mayor que el valor máximo.';
      } else {
        errorSpan.textContent = '';
      }
    });

    minSelect.addEventListener('change', function () {
      const minValue = parseInt(minSelect.value);
      const maxValue = parseInt(maxSelect.value);

      if (maxValue < minValue) {
        errorSpan.textContent = 'El valor máximo no puede ser menor que el valor mínimo.';
      } else {
        errorSpan.textContent = '';
      }
    });
  });
    </script>

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

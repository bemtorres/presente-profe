<template>
  <div class="row">
    <div class="col-md-12 row">
      <div class="col-md-12 mb-3">
        <p class="card-text d-flex justify-content-between align-items-center">
          <span>📅<strong>Calendario de disponibilidad de salas</strong></span>
          <span class="badge bg-primary rounded-pill">
            <strong>{{ props.semestre.nombre }}</strong>
          </span>
        </p>
      </div>

      <div class="col-md-6 d-grid mb-3">
        <button type="button" class="btn btn-dark"
          @click="accionEditable">
          Activar solicitud
          <i  v-if="!editable" class="mx-2 fa fa-circle text-danger"></i>
          <i  v-if="editable" class="mx-2 fa fa-circle text-success"></i>
          <!-- <span v-if="!editable" class="badge bg-danger"></span> -->
          <!-- <span v-if="editable" class="badge bg-success">-</span> -->
        </button>

      </div>
      <div class="col-md-6 d-grid mb-3">
        <button v-if="editable" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSolicitud">
          <span id="text-guardar">Enviar solicitud</span>
        </button>
      </div>

      <!-- MODAL -->
      <div class="modal fade" id="modalSolicitud" tabindex="-1" aria-labelledby="modalSolicitudLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalSolicitudLabel">Resumen solicitud de sala</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-2" v-if="usuario != null">
                <div class="row">
                  <div class="col-3">
                    <img :src="usuario.img" width="100" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-8">
                    <div class="card-body">
                      <p class="card-title">{{  usuario.nombre_completo  }}</p>
                      <small>{{ usuario.run  }}</small>
                      <p class="card-text">{{  usuario.correo }}</p>
                      <span class="badge bg-dark rounded-pill">{{ usuario.sede }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td class="text-center">
                        <strong>{{ vsala.nombre }}</strong>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <small>{{ vsemana.info }}</small>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td class="text-center bg-dark text-white">
                        <strong>DÍAS SOLICITADOS</strong>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Jueves 12 de agosto de 2021 <br>
                        10:00 - 12:00
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Jueves 12 de agosto de 2021 <br>
                        10:00 - 12:00
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Jueves 12 de agosto de 2021 <br>
                        10:00 - 12:00
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="d-grid gap-2 mt-3">
                <button type="button" class="btn btn-success btn-lg">Enviar solicitud</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 row">
      <div class="col-md-6">
        <div class="form-group mb-3">
          <label for="vsala" class="mb-1">Seleccionar sala</label>
          <select class="form-control" id="vsala" v-model="vsala" @change="handleSelectChange">
            <option v-for="sala, j in salas" :key="j" :value="sala">
              {{ sala.nombre }}
            </option>
          </select>
        </div>

      </div>
      <div class="col-md-6">
        <label for="vsemana" class="mb-1">Seleccionar sala</label>
        <select class="form-control" id="vsemana" v-model="vsemana" @change="handleSelectChange">
          <option v-for="sd, k in semanasdetall" :value="sd" :key="k">
            {{ sd.info }}
          </option>
        </select>
      </div>

    </div>

    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
          <thead>
            <tr>
              <th colspan="2" style="width:10px">

              </th>
              <th class="text-center" v-for="(semana, i) in semanas" :key="i">
                <strong>{{ semana }}</strong>
              </th>
            </tr>
            <tr>
              <th colspan="2">

              </th>
              <th class="text-center" v-for="fecha in fechaSiguiente" :key="fecha">
                {{ fecha }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(horario, index) in props.horarios" :key="index" class="">
              <td class="text-center">
                <strong>{{ index + 1 }}</strong>
              </td>
              <td class="text-center">
                <small>{{ horario[0] + " - " + horario[1] }}</small>
              </td>
              <td
                v-for="(dia, index2) in dias"
                :key="dia + index2"
                @click="selectedHorario(dia + '-' + (index + 1))"
                :class="selectClases(dia + '-' + (index + 1))"
                class="item-selected"
              >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref, onMounted } from "vue";
  import { postData } from '@/components/conexion/api.js';
  import { calcularFechasSiguientes } from '@/components/lib/index.js';
  import { agregarObjeto, actualizarPorId, buscarPorId, eliminarPorId } from '@/components/lib/crud.js';
  import { toastSuccess, toastError, toastInfo } from '@/components/lib/toast.js';
  import { alertInfo } from '@/components/lib/alert.js';

  const props = defineProps({
    horarios: Array,
    salas: Array,
    semestre: {},
    semanasdetall: {},
    postBuscarCalendario: String,
    postStoreCalendario: String
  });

  const semanas = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
  const dias = ["L", "M", "X", "J", "V", "S"];
  const fechaSiguiente = ref([]);

  let data = ref([]); // informacion del horario
  // const meData = ref([]); // informacion de mi horario

  const vsala = ref("");
  const vsemana = ref("");
  const editable = ref(false);

  // ACTION: save usuario
  const usuario = ref(null);

  onMounted(() => {
    initializeData();
  });

  const initializeData = () => {
    if (props.semanasdetall.length > 0) {
      vsemana.value = props.semanasdetall[0];
    }

    if (props.salas.length > 0) {
      vsala.value = props.salas[0];
    }

    fechaSiguiente.value = calcularFechasSiguientes(vsemana.value.fecha_inicio);
    handleSelectChange();
  };

  const accionEditable = () => {
    if (isUsuario()) {
      editable.value = !editable.value;
    }
  }

  const isUsuario = () => {
    // ACTION: save usuario
    usuario.value = window._USUARIO;
    if (usuario.value == null) {
      alertInfo("Información","Debes tener una cuenta de usuario para solicitar una sala");
      return false;
    }
    return true;
  }

  const selectedHorario = (casilla) => {
    if (!editable.value) {
      return;
    }

    var arreglo = casilla.split("-");
    var selecionado = {
      id: casilla,
      dia: arreglo[0],
      modulo: arreglo[1],
      estado: 1,
      color: "verde",
    };

    var obj = buscarPorId(data ,selecionado.id);
    if (obj != null) {
      if (obj.color == "verde") {
        data = eliminarPorId(data, obj.id);
      }
    } else {
      data = agregarObjeto(data, selecionado);
    }

    miHorarioInfo();
    // console.log("data me me", meData.value);
  };

  const miHorarioInfo = () => {
    // meHorario = [];

    // data.value.forEach(horario => {
    //   if (horario.color == "verde") {
    //     var obj = {
    //       id: horario.id,
    //       dia: horario.dia,
    //       modulo: horario.modulo,
    //       estado: 1,
    //       color: horario.color,
    //     };

    //     meHorario = addObjeto(meHorario, obj);
    //   }

    //   meData.value = meHorario;
    // });
  }

  const selectClases = (casilla) => {
    var obj = buscarPorId(data, casilla);
    if (obj != null) {
      if (obj.color == "gris") {
        return "bg-dark";
      } else if (obj.color == "verde") {
        return "bg-warning";
      }
    } else {
      return "";
    }
  };

  const convertToHorario = (horarios) => {
    data.value = [];

    horarios.forEach(horario => {
      var obj = {
        id: horario.id,
        dia: horario.dia,
        modulo: horario.modulo,
        estado: 1,
        color: horario.color,
      };

      data = agregarObjeto(data, obj);
    });
  }

  const handleSelectChange = () => {
    fechaSiguiente.value = calcularFechasSiguientes(vsemana.value.fecha_inicio);

    // ACTION: save usuario
    usuario.value = window._USUARIO;

    postData(props.postBuscarCalendario,
      {
        periodo: vsemana.value.periodo,
        sala: vsala.value.id,
        semana: vsemana.value.semana,
      }
    ).then((data) => {
      convertToHorario(data.data);
    })
    .catch((error) => {
      toastError("Error al cargar el horario")
      console.log("error", error);
    });
  }

  const handleAddHorario = () => {
    // postData(props.postStoreCalendario,
    //   {
    //     periodo: vsemana.value.periodo,
    //     sala: vsala.value.id,
    //     semana: vsemana.value.semana,
    //     horarios: data.value,
    //   }
    // ).then((data) => {
    //   toastSuccess("Horario guardado correctamente");
    // })
    // .catch((error) => {
    //   toastError("Error al guardar el horario")
    //   console.log("error", error);
    // });
  }
</script>

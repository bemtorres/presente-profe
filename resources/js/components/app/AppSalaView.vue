<template>
  <div class="row">
    <div class="col-md-12 row">
      <div class="col-md-12 mb-3">
        <p class="card-text d-flex justify-content-between align-items-center">
          <span>📅<strong>Calendario de disponibilidad de salas</strong></span>
          <div>
            <span class="badge bg-dark cursor rounded-pill" data-bs-toggle="modal" data-bs-target="#questionModal">
              <i class="fa fa-2x fa-question"></i>
            </span>
          </div>
        </p>
      </div>

      <div class="col-md-6 d-grid mb-3">
        <button type="button" class="btn btn-dark" @click="accionEditable">
          Activar solicitud
          <i v-if="!editable" class="mx-2 fa fa-circle text-danger"></i>
          <i v-if="editable" class="mx-2 fa fa-circle text-success"></i>
          <!-- <span v-if="!editable" class="badge bg-danger"></span> -->
          <!-- <span v-if="editable" class="badge bg-success">-</span> -->
        </button>
      </div>
      <div class="col-md-6 d-grid mb-3">
        <button
          v-if="editable && meData.length > 0 && usuario != null"
          class="btn btn-success"
          data-bs-toggle="modal"
          data-bs-target="#modalSolicitud"
          :disabled="meData.length == 0"
          @click="handleModalSolicitud"
        >
          <span id="text-guardar">Enviar solicitud</span>
        </button>
      </div>
    </div>

    <!-- MODAL -->
    <div
      class="modal fade"
      id="modalSolicitud"
      tabindex="-1"
      aria-labelledby="modalSolicitudLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalSolicitudLabel">
              Solicitud de sala: <strong>{{ vsala.nombre }}</strong>
            </h1>
            <button
              type="button"
              ref="btnCloseSolicitudModal"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="" v-if="usuario != null">
              <div class="row">
                <small class="text-center">{{ vsemana.info }}</small>
                <div class="col-2 text-center">
                  <img
                    :src="usuario.img"
                    width="70"
                    class="img-fluid rounded-start"
                    alt="..."
                  />
                  <!-- <small class="badge bg-dark rounded-pill">{{ usuario.sede }}</small> -->
                </div>
                <div class="col-8">
                  <div class="card-body">
                    <p class="card-title">{{ usuario.nombre_completo }}</p>
                    <small>{{ usuario.run }}</small>
                    <p class="card-text">{{ usuario.correo }}</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-sm table-striped">
                <tbody>
                  <tr>
                    <td colspan="2" class="text-center bg-dark text-white">
                      <strong>MÓDULOS SOLICITADOS</strong>
                    </td>
                  </tr>
                  <tr
                    v-for="(mihorario, mihorarioindex) in meData"
                    :key="mihorarioindex"
                    class=""
                  >
                    <!-- <td>
                      {{ mihorario.modulo }}
                    </td> -->
                    <td>
                      {{ mihorario.info.hora }}
                    </td>
                    <td class="text-end">
                      {{ mihorario.info.dia }}, {{ mihorario.info.fecha2 }} <br />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="form-group mb-3">
              <label for="vmotivo" class="mb-2"
                >Seleccionar el motivo<small class="text-danger">*</small></label
              >
              <select class="form-control form-lg" id="vmotivo" v-model="vmotivo">
                <option v-for="(motivo, m) in props.motivos" :key="m" :value="m">
                  {{ motivo }}
                </option>
              </select>
            </div>
            <div class="form-group mb-3" v-if="vmotivo == 100">
              <label for="vmotivoInput" class="mb-1"
                >Otros motivos<small class="text-danger">*</small></label
              >
              <input
                type="text"
                class="form-control"
                id="vmotivoInput"
                v-model="vmotivoInput"
                :required="vmotivo == 100"
              />
            </div>

            <div class="d-grid gap-2 mt-3">
              <button
                type="button"
                @click="handleSolicitud"
                class="btn btn-success btn-lg"
                :disabled="(meData.length == 0 || usuario == null) || isEnviando"
              >
                Enviar solicitud
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- SELECCIONAR SALA -->
    <div class="col-md-12 row">
      <div class="col-md-6">
        <div class="form-group mb-3">
          <label for="vsala" class="mb-1">Seleccionar sala</label>
          <!-- <select
            class="form-control"
            id="vsala"
            v-model="vsala"
            @change="handleSelectChange"
          >


            <option v-for="(sala, j) in salas" :key="j" :value="sala">
              {{ sala.nombre }}
            </option>
          </select> -->

          <VueMultiselect
            v-model="vsala"
            :options="salas"
            label="nombre"
            :allow-empty="false"
            placeholder="Seleccione una sala"
            selectLabel=""
            @select="handleSelectChange"
            >
          </VueMultiselect>


        </div>
      </div>
      <div class="col-md-6">
        <label for="vsemana" class="mb-1">Seleccionar sala</label>
        <select
          class="form-control"
          id="vsemana"
          v-model="vsemana"
          @change="handleSelectChange"
        >
          <option v-for="(sd, k) in semanasdetall" :value="sd" :key="k">
            {{ sd.info }}
          </option>
        </select>
      </div>
    </div>
    <!-- TABLA -->
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
          <thead>
            <tr>
              <th colspan="2" style="width: 10px"></th>
              <th class="text-center" v-for="(semana, i) in semanas" :key="i">
                <strong>{{ semana }}</strong>
              </th>
            </tr>
            <tr>
              <th colspan="2"></th>
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
import { ref, onMounted, handleError } from "vue";
import { postData } from "@/components/conexion/api.js";
import {
  calcularFechasSiguientes,
  convertirFechaCodigo,
  orderFecha,
} from "@/components/lib/index.js";
import {
  agregarObjeto,
  actualizarPorId,
  buscarPorId,
  eliminarPorId,
} from "@/components/lib/crud.js";
import { addObjeto } from "@/components/lib/crudArray.js";
import { toastError } from "@/components/lib/toast.js";
import {
  alertSuccess,
  alertSuccessTime,
  alertWarning,
  alertInfo,
} from "@/components/lib/alert.js";

import VueMultiselect from 'vue-multiselect';

const props = defineProps({
  horarios: Array,
  salas: Array,
  motivos: {},
  semestre: {},
  semanasdetall: {},
  postBuscarCalendario: String,
  postStoreCalendario: String,
  postStoreSolicitud: String,
});

const semanas = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
const dias = ["L", "M", "X", "J", "V", "S"];
const fechaSiguiente = ref([]);

let data = ref([]); // informacion del horario
const meData = ref([]); // informacion de mi horario
const vsala = ref("");
const vsemana = ref("");
const vmotivo = ref(10); // default posicion 0
const vmotivoInput = ref(""); // default posicion 0
const editable = ref(false);


// ACTION: save usuario
const usuario = ref(null);
const btnCloseSolicitudModal = ref(null);
const isEnviando = ref(false);

onMounted(() => {
  initializeData();
});

const initializeData = () => {
  if (props.semanasdetall.length > 0) {
    props.semanasdetall.forEach((semana) => {
      if (semana.today) {
        vsemana.value = semana;
      }
    });
  }

  if (props.salas.length > 0) {
    vsala.value = props.salas[0];
  }

  fechaSiguiente.value = calcularFechasSiguientes(vsemana.value.fecha_inicio);
  handleSelectChange();

  // console.log("props", props);
};

const accionEditable = () => {
  if (isUsuario()) {
    editable.value = !editable.value;
  }
};

const isUsuario = () => {
  // ACTION: save usuario
  usuario.value = window._USUARIO;
  if (usuario.value == null) {
    alertInfo("Información", "Debes tener una cuenta de usuario para solicitar una sala");
    return false;
  }
  return true;
};

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

  var obj = buscarPorId(data, selecionado.id);
  if (obj != null) {
    if (obj.color == "verde") {
      data = eliminarPorId(data, obj.id);
    }
  } else {
    data = agregarObjeto(data, selecionado);
  }

  miHorarioInfo();
};

const miHorarioInfo = () => {
  let meHorario = [];

  data.value.forEach((h) => {
    if (h.color == "verde") {
      var info = convertirFechaCodigo(h, props.horarios, fechaSiguiente.value);
      var obj = {
        id: h.id,
        dia: h.dia,
        modulo: h.modulo,
        estado: 1,
        color: h.color,
        info: info,
      };

      meHorario = addObjeto(meHorario, obj);
    }
  });

  meData.value = orderFecha(meHorario);
};

const selectClases = (casilla) => {
  var obj = buscarPorId(data, casilla);
  if (obj != null) {
    if (obj.color == "gris") {
      return "bg-dark";
    } else if (obj.color == "info") {
      return "bg-secondary";
    } else if (obj.color == "verde") {
      return "bg-warning";
    }
  } else {
    return "";
  }
};

const convertToHorario = (horarios) => {
  data.value = [];

  horarios.forEach((horario) => {
    var obj = {
      id: horario.id,
      dia: horario.dia,
      modulo: horario.modulo,
      estado: 1,
      color: horario.color,
    };

    data = agregarObjeto(data, obj);
  });
};

const handleSelectChange = () => {
  fechaSiguiente.value = calcularFechasSiguientes(vsemana.value.fecha_inicio);

  // ACTION: save usuario
  usuario.value = window._USUARIO;
  meData.value = []; // reinicio mi horario

  postData(props.postBuscarCalendario, {
    periodo: vsemana.value.periodo,
    sala: vsala.value.id,
    semana: vsemana.value.semana,
  })
    .then((data) => {
      convertToHorario(data.data);
      // console.log(data.data);
    })
    .catch((error) => {
      toastError("Error al cargar el horario");
      console.log("error", error);
    });
};

const handleModalSolicitud = () => {
  isUsuario();
}

const handleSolicitud = () => {
  if (!isUsuario()) {
    alertInfo("Información", "Debes tener una cuenta de usuario para solicitar una sala");
    return;
  }

  if (vmotivo.value == 100 && vmotivoInput.value == "") {
    alertWarning("Falta información", "Debes ingresar un motivo");
    return;
  }

  isEnviando.value = true;

  postData(props.postStoreSolicitud, {
    sala: vsala.value,
    semana: vsemana.value,
    horarios: meData.value,
    usuario: usuario.value,
    motivo: vmotivo.value,
    motivoInput: vmotivoInput.value,
  })
    .then((data) => {
      alertSuccessTime("Solicitud enviada", "Se ha generado una solicitud de sala ID: " + data.solicitud.id);
      // console.log("data", data);
    })
    .catch((error) => {
      toastError("Error al guardar el horario");
      console.log("error", error);
    });
};
</script>

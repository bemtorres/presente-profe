<template>
  <div class="row">
    <div class="col-md-12 row">
      <div class="col-md-3">
        <div class="form-group mb-3">
          <label for="">Seleccionar sala</label>
          <select class="form-control" v-model="vsala" @change="handleSelectChange">
            <option v-for="sala, j in salas" :key="j" :value="sala">
              {{ sala.nombre }}
            </option>
          </select>
        </div>
      </div>
      <div class="col-md-5">
        <button type="button" class="btn btn-sm btn-primary mx-2" @click="accionEditable">
          Editar
          <span v-if="!editable" class="badge bg-danger">OFF</span>
          <span v-if="editable" class="badge bg-success">ON</span>
        </button>

        <button v-if="editable" class="btn btn-success btn-sm" id="btn-enviar" @click="handleAddHorario">
          <!-- <span id="spinner-enviar" hidden>
            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
            <span role="status"> Guardando...</span>
          </span> -->
          <span id="text-guardar">Guardar</span>
        </button>
      </div>
    </div>
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
          <thead>
            <tr>
              <th colspan="2" style="width:10px">
                Seleccione la semana a programar
              </th>
              <th class="text-center" v-for="(semana, i) in semanas" :key="i">
                <strong>{{ semana }}</strong>
              </th>
            </tr>
            <tr>
              <th colspan="2">
                <select class="form-control" name="" id="" v-model="vsemana" @change="handleSelectChange">
                  <option v-for="sd, k in semanasdetall" :value="sd" :key="k">
                    {{ sd.info }}
                  </option>
                </select>
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
              ></td>
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

  const vsala = ref("");
  const vsemana = ref("");
  const editable = ref(false);

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
    editable.value = !editable.value;
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
      color: "gris",
    };

    var obj = buscarPorId(data ,selecionado.id);
    if (obj != null) {
      data = eliminarPorId(data, obj.id);
    } else {
      data = agregarObjeto(data, selecionado);
    }

    console.log("data", data);
  };

  const selectClases = (casilla) => {
    var obj = buscarPorId(data, casilla);
    if (obj != null) {
      if (obj.color == "gris") {
        return "bg-dark";
      }
      if (obj.color == "verde") {
        return "bg-success";
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

    postData(props.postBuscarCalendario,
      {
        periodo: vsemana.value.periodo,
        sala: vsala.value.id,
        semana: vsemana.value.semana,
      }
    ).then((data) => {
      convertToHorario(data.data);
      toastInfo("Horario cargado correctamente");
    })
    .catch((error) => {
      toastError("Error al cargar el horario")
      console.log("error", error);
    });
  }

  const handleAddHorario = () => {
    postData(props.postStoreCalendario,
      {
        periodo: vsemana.value.periodo,
        sala: vsala.value.id,
        semana: vsemana.value.semana,
        horarios: data.value,
      }
    ).then((data) => {
      toastSuccess("Horario guardado correctamente");
    })
    .catch((error) => {
      toastError("Error al guardar el horario")
      console.log("error", error);
    });
  }
</script>

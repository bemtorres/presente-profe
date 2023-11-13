<template>
  <div class="row">
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
import { ref, onMounted, toRaw } from "vue";
import { postData } from "@/components/conexion/api.js";
import {
  calcularFechasSiguientes,
} from "@/components/lib/index.js";
import {
  agregarObjeto,
  buscarPorId,
} from "@/components/lib/crud.js";
import { addObjeto } from "@/components/lib/crudArray.js";
import { toastError } from "@/components/lib/toast.js";

const props = defineProps({
  horarios: Array,
  solicitud: {},
  semanasdetall: {},
  postBuscarCalendario: String,
});

const semanas = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
const dias = ["L", "M", "X", "J", "V", "S"];
const fechaSiguiente = ref([]);

let data = ref([]); // informacion del horario

const vsala = ref("");
const vsemana = ref("");

onMounted(() => {
  initializeData();
});

const initializeData = () => {
  console.log('props',props);
  if (props.semanasdetall.length > 0) {
    vsemana.value = props.semanasdetall[props.solicitud.semana - 1];
  }

  vsala.value = props.solicitud.sala;
  fechaSiguiente.value = calcularFechasSiguientes(vsemana.value.fecha_inicio);
  handleSelectChange();
};

const selectClases = (casilla) => {
  var obj = buscarPorId(data, casilla);
  if (obj != null) {
    if (obj.color == "gris") {
      return "bg-dark";
    } else if (obj.color == "info") {
      return "bg-success";
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

  postData(props.postBuscarCalendario, {
    periodo: vsemana.value.periodo,
    sala: vsala.value.id,
    semana: vsemana.value.semana,
    solicitud: props.solicitud.id,
  })
    .then((data) => {
      convertToHorario(data.data);
      console.log(toRaw(data));
    })
    .catch((error) => {
      toastError("Error al cargar el horario");
      console.log("error", error);
    });
};

</script>

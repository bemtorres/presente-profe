@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row g-2">
    <div class="col-6">
      <div class="p-3">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Salas pedidas por dia</h4>
            <p class="card-text">Texto</p>
            <canvas id="barras"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="p-3">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Promedio de salas pedidas por piso en la semana</h4>
            <p class="card-text">Texto</p>
            <canvas id="lineas"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="p-3">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Peticion de salas Alumno Profesor</h4>
            <p class="card-text">Texto</p>
            <canvas id="tortita"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="p-3">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Salas pedidas por sede</h4>
            <p class="card-text">Texto</p>
            <canvas id="radar"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="p-3">
        <div id="chart1" class="chart">
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('template/comparte/index.js') }}"></script>
<link rel="stylesheet" type="text/css" src="{{ asset('template/css/chartjs.css')}}">

<script>

  //Grafico de barras
  const barras = document.getElementById('barras');
  new Chart(barras, {
    type: 'bar',
    data: {
      labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
      datasets: [{
        label: 'Numero de salas pedidas',
        data: [30, 34, 22, 27, 33, 40],
        borderColor: '#1A1A1A',
        backgroundColor: ['#F1B634'],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

//Grafico de lineas
  const lineas = document.getElementById('lineas');
  new Chart(lineas, {
    type: 'line',
    data: {
      labels: ['Piso 1','Piso 2','Piso 3','Piso 4','Piso 5','Piso 6','Piso 7','Piso 8'],
      datasets:[{
        label: 'Salas por piso',
        borderColor: '#1A1A1A',
        backgroundColor: ['#F1B634'],
        data:[12,6,22,5,11,13,19,30],
        borderWidth: 1
      }]
    },
    options: {
      scales:{
        y: {
          beginAtZero: true
        }
      }
    }
  });

  //Grafico de torta
  const torta = document.getElementById('tortita');
  new Chart(torta,{
    type: 'doughnut',
    data: {
      labels:['Alumno','Profesor'],
      datasets:[{
        data:[30,70],
        backgroundColor:['#F1B634','#666666']
      }],

    }
  });

  //Grafico radar - Salas pedidas por sedes
  const radar = document.getElementById('radar');
  new Chart(radar,{
    type: 'polarArea',
    data:{
      labels:['San Joaquin','Plaza Vespucio','San Bernardo','Antonio Varas','Alameda','Maipu'
      ,'Melipilla','Padre Alonso De Ovalle'],
      datasets:[{
        data:[12,13,14,15,16,17,18,19]
      }]
    }
  })
  const getOptionsChart1=()=>{
    return {
      xAxis: {
      type: 'category',
      data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']},
      yAxis: {
      type: 'value'},
      series: [
      {
        data: [150, 230, 224, 218, 135, 147, 260],
        type: 'line'
      }]
    };
  };
  const initCharts = () => {
    const chart1 = echarts.init(documento.getElementById("chart1"));

    chart1.setOption(getOptionsChart1());
  };


</script>
@endpush

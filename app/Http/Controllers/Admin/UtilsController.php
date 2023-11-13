<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendario;
use App\Models\Sala;
use App\Models\Sede;
use App\Models\Semestre;
use App\Services\DuocHorario;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class UtilsController extends Controller
{

  public $numero = 1;

  public function index() {
    return view('admin.utils.index');
  }

  public function calendario() {
    $sedes = Sede::get();
    $semestres = Semestre::get();
    return view('admin.utils.calendario', compact('sedes','semestres'));
  }

  public function calendarioStore(Request $request) {
    // return $request;
    $sede = $request->input('sede');
    $periodo = $request->input('semestre');

    $data = [];
    if ($request->hasFile('excel_file')) {
      $file = $request->file('excel_file');

      $data = Excel::toArray([], $file)[0];

      //return $data;
      $salas = $this->getSala($data, $sede, $periodo);

      $calendario = [];
      foreach ($data as $key => $v) {
        if ($key == 0) { continue; }
        if (empty($v[36])) { continue; } // sala null


        $sala = new Sala;

        foreach ($salas as $keyS => $valueS) {
          if ($valueS->codigo == $v[36]) {
            $sala = $valueS;
            break;
          }
        }

        // $info = [
        //   'plan'=> $v[7],
        //   'escuela' => $v[8],
        //   'jornada' => $v[10],
        //   'nivel' => $v[11],
        // ];

        // $seccion = [
        //   'id' => $v[12],
        //   'seccion' => $v[13],
        //   'nombre' => $v[14],
        //   'asignatura' => [
        //     'id' => $v[20],
        //     'codigo' => $v[21],
        //     'nombre' => $v[22],
        //   ],
        //   'metodologia' => $v[29],
        //   'docente' => [
        //     'id' => $v[32],
        //     'rut' => $v[33],
        //     'nombre' => $v[34],
        //   ],
        // ];

        $dias = [
          'L' => $v[41],
          'M' => $v[42],
          'X' => $v[43],
          'J' => $v[44],
          'V' => $v[45],
          'S' => $v[46],
        ];

        $clase = [
          'hi' => $v[39],
          'ht' => $v[40],
          'hora_inicio' => $this->getTime($v[39]),
          'hora_termino' => $this->getTime($v[40]),
          'dia' => $this->validateDay($dias),
          'id_sala' => $sala->id ?? null,
          'modulo' => 0
        ];

        $clase['modulo'] =  $this->getModulo($clase['hora_inicio'], $clase['hora_termino']) + 1 ?? 0;

        array_push($calendario, $clase);
      }

      // return $calendario;

      foreach ($calendario as $keyC => $vc) {
        for ($i=1; $i <= 18; $i++) {
          $c = new Calendario();
          $c->periodo = $periodo;
          $c->semana = $i;
          $c->dia = $vc['dia'][1];
          $c->modulo = $vc['modulo'];
          $c->id_sede = $sede;
          $c->id_sala = $vc['id_sala'];
          $c->tipo = 2;
          $c->save();
        }
      }
    }

    return Calendario::get();
  }


  private function getTime(string $time) {
    $hora = Date::excelToDateTimeObject($time);
    $time = $hora->format('H:i');
    return $time;
  }

  private function getModulo($fi, $ft) {
    $horarios = DuocHorario::TIMES;

    foreach ($horarios as $key => $h) {
      // if ($fi == $h[0] && $ft == $h[1]) {
      if ($fi == $h[0] ) {
        return $key;
      }
    }
  }

  private function validateDay($arreglo) {
    //var_dump($arreglo); // Agrega esta línea para depurar
    $n = 1;
    foreach ($arreglo as $key => $value) {
        if (trim(strtolower($value)) == 'x') {
            return [$key, $n];
        }
        $n++;
    }
    return null;
}


  private function getSala($data, $sede, $periodo) {
    $salas = [];

    foreach ($data as $keyF => $valueF) {
      if ($keyF > 0) {
        $s = [
          'aula' => $valueF[36] ?? 'SALAFANTASMA',
          'denominacion' => $valueF[37] ?? 'SALAFANTASMA',
        ];
        array_push($salas, $s);
      }
    }

    $salas = array_filter($salas, function ($value) {
      return $value !== null;
    });

    $uniques = array_map("unserialize", array_unique(array_map("serialize", $salas)));

    // Vuelve a indexar el arreglo resultante
    $uniques = array_values($uniques);


    $salas = Sala::where('id_sede', $sede)->where('periodo', $periodo)->get();


    foreach ($uniques as $keyu => $value) {
      if ($value['aula'] == 'SALAFANTASMA') {
        continue;
      }

      $uniques[$keyu]['found'] = false;
      foreach ($salas as $keys => $sala) {
        if ($value['aula'] == $sala['codigo']) {
          $uniques[$keyu]['found'] = true;
          break;
        }
      }
    }


    foreach ($uniques as $key => $value) {
      if ($value['aula'] == 'SALAFANTASMA') {
        continue;
      }

      if ($value['found']) {
        continue;
      }

      $s = new Sala();
      $s->periodo = $periodo;
      $s->nombre = $value['denominacion'];
      $s->codigo = $value['aula'];
      $s->id_sede = $sede;
      $s->save();
    }

    return Sala::where('id_sede', $sede)->where('periodo', $periodo)->get();
  }

  public function correo() {
    return view('admin.utils.correo');
  }
}

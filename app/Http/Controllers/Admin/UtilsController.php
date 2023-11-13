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


      $salas = $this->getSala($data, $sede, $periodo);

      $calendario = [];
      foreach ($data as $key => $v) {
        if ($key == 0) { continue; }
        if (empty($v[35])) { continue; }


        $sala = null;

        // return $salas;

        foreach ($salas as $keyS => $valueS) {
          if ($valueS->codigo == $v[34]) {
            $sala = $valueS;
            break;
          }
        }

        $info = [
          'plan'=> $v[7],
          'escuela' => $v[8],
          'jornada' => $v[9],
          'nivel' => $v[10],
        ];

        $seccion = [
          'id' => $v[12],
          'seccion' => $v[13],
          'nombre' => $v[14],
          'asignatura' => [
            'id' => $v[18],
            'codigo' => $v[19],
            'nombre' => $v[20],
          ],
          'metodologia' => $v[27],
          'docente' => [
            'id' => $v[30],
            'rut' => $v[31],
            'nombre' => $v[32],
          ],
        ];

        $dias = [
          'L' => $v[39],
          'M' => $v[40],
          'X' => $v[41],
          'J' => $v[42],
          'V' => $v[43],
          'S' => $v[44],
        ];

        $clase = [
          'hora_inicio' => $this->getTime($v[37]),
          'hora_termino' => $this->getTime($v[38]),
          'dia' => $this->validateDay($dias),
        ];

        $clase['modulo'] =  $this->getModulo($clase['hora_inicio'], $clase['hora_termino']) + 1 ?? 0;

        $c = [
          'info' => $info,
          'seccion' => $seccion,
          'clase' => $clase,
          'sala' => $sala,
        ];

        array_push($calendario, $c);
      }


      foreach ($calendario as $keyC => $vc) {
        for ($i=1; $i <= 18; $i++) {
          $c = new Calendario();
          $c->periodo = $periodo;
          $c->semana = $i;
          $c->dia = $vc['clase']['dia'][1];
          $c->modulo = $vc['clase']['dia'][1];
          $c->info = $vc['seccion'];
          $c->id_sede = $sede;
          $c->id_sala = $vc['sala']->id;
          $c->tipo = 2;
          $c->save();
        }
      }
    }

    return 'ok';
  }


  private function getTime($time) {
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
    $n = 1;
    foreach ($arreglo as $key => $value) {
      if (trim(strtolower($value) == 'x')) {
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
          'aula' => $valueF[34] ?? 'SALAFANTASMA',
          'denominacion' => $valueF[35] ?? 'SALAFANTASMA',
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

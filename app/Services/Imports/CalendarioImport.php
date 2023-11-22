<?php

namespace App\Services\Imports;

use App\Models\Calendario;
use App\Models\Sala;
use App\Services\DuocHorario;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CalendarioImport {
  protected $request;

  const COLUMN = [
    'plan' => 7,
    'escuela' => 8,
    'jornada' => 10,
    'nivel' => 11,
    'seccion' => 12,
    'nombre_seccion' => 13,
    'asignatura_id' => 20,
    'asignatura_codigo' => 21,
    'asignatura_nombre' => 22,
    'metodologia' => 29,
    'docente_id' => 32,
    'docente_rut' => 33,
    'docente_nombre' => 34,
    'SALA' => 36,
    'DENOMINACION' => 37,
    'HI' => 39,
    'HT' => 40,
    'LUNES' => 41,
    'MARTES' => 42,
    'MIERCOLES' => 43,
    'JUEVES' => 44,
    'VIERNES' => 45,
    'SABADO' => 46,
  ];

  public function __construct(Request $request){
    $this->request = $request;
  }

  public function call() {
    $sede = $this->request->input('sede');
    $periodo = $this->request->input('semestre');

    $data = [];
    try {
      if ($this->request->hasFile('excel_file')) {
        $file = $this->request->file('excel_file');
        $data = Excel::toArray([], $file)[0];
        $salas = $this->getSala($data, $sede, $periodo);

        $calendario = [];
        foreach ($data as $key => $v) {
          if ($key == 0) { continue; } // limpiar cabecera
          if (empty($v[self::COLUMN['SALA']])) { continue; } // sala null

          $sala = new Sala;

          foreach ($salas as $keyS => $valueS) {
            if ($valueS->codigo == $v[self::COLUMN['SALA']]) {
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
            'L' => $v[self::COLUMN['LUNES']],
            'M' => $v[self::COLUMN['MARTES']],
            'X' => $v[self::COLUMN['MIERCOLES']],
            'J' => $v[self::COLUMN['JUEVES']],
            'V' => $v[self::COLUMN['VIERNES']],
            'S' => $v[self::COLUMN['SABADO']],
          ];

          $hi = $v[self::COLUMN['HI']];
          $ht = $v[self::COLUMN['HT']];

          $clase = [
            'hi' => $hi,
            'ht' => $ht,
            'hora_inicio' => $this->getTime($hi),
            'hora_termino' => $this->getTime($ht),
            'dia' => $this->validateDay($dias),
            'id_sala' => $sala->id ?? null,
            'modulo' => 0
          ];

          $clase['modulo'] = $this->getModulo($clase['hora_inicio'], $clase['hora_termino']) + 1 ?? 0;

          array_push($calendario, $clase);
        }

        foreach ($calendario as $keyC => $vc) {
          // desde la semana 15 a la 18
          for ($i=16; $i <= 18; $i++) {
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
        return true;
      } else {
        return false;
      }
    } catch (\Throwable $th) {
      //throw $th;
      return $th;
    }
  }

  // PRIVATE FUNCTIONS

  private function getTime(string $time) {
    $hora = Date::excelToDateTimeObject($time);
    $time = $hora->format('H:i');
    return $time;
  }

  private function getModulo($fi, $ft) {
    $horarios = DuocHorario::TIMES;
    foreach ($horarios as $key => $h) {
      if ($fi == $h[0] ) {
        return $key;
      }
    }
  }

  private function validateDay($arreglo) {
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
          'aula' => $valueF[self::COLUMN['SALA']] ?? 'SALAFANTASMA',
          'denominacion' => $valueF[self::COLUMN['DENOMINACION']] ?? 'SALAFANTASMA',
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

}

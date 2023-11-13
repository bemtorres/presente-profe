<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use App\Models\Sede;
use App\Models\Semestre;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

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
      return $salas;

      $horarios = [];
      foreach ($data as $keyF => $valueF) {

        $id_sede = 1;
        foreach ($salas as $keyS => $s) {
          if ($s->codigo == $valueF[34]) {
            $id_sede = $s->id;
            break;
          }
        }

        if ($keyF > 0) {
          $s = [
            'aula' => $valueF[34] ?? 'SALAFANTASMA',
            'denominacion' => $valueF[35] ?? 'SALAFANTASMA',
            'id_sede' => $id_sede
          ];
          array_push($horarios, $s);
        }
      }


      return 'ok';

      // $data ahora contiene un arreglo con las filas y columnas del archivo Excel
      // return [
      //   $data[0] ,
      //   $data[1]
      // ];
      // Puedes iterar sobre $data para procesar cada fila y columna según tus necesidades
      // foreach ($data as $row) {
      //     // Procesar cada fila
      //     foreach ($row as $cell) {
      //         // Procesar cada celda
      //         // $cell contiene el valor de la celda
      //     }
      // }
    }

    return $data;
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


    return $uniques;

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

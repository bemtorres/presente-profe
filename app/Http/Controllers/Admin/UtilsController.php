<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    $data = [];
    if ($request->hasFile('excel_file')) {
      $file = $request->file('excel_file');

      $data = Excel::toArray([], $file)[0];

      // $data ahora contiene un arreglo con las filas y columnas del archivo Excel
      // return [
      //   $data[0] ,
      //   $data[1]
      // ];
      // Puedes iterar sobre $data para procesar cada fila y columna según tus necesidades
      foreach ($data as $row) {
          // Procesar cada fila
          foreach ($row as $cell) {
              // Procesar cada celda
              // $cell contiene el valor de la celda
          }
      }
    }

    return $data;
  }
}

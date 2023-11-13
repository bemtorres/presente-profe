<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// use App\Http\Requests\AuthLoginRequest as AuthRequest;

class HomeController extends Controller
{
  public function index() {
    $sede = Sede::findOrFail(current_user()->id_sede);

    return view('home.index', compact('sede'));
  }


  public function indexPost(Request $request) {
    $data = [];
    if ($request->hasFile('excel_file')) {
      $file = $request->file('excel_file');

      // Procesar el archivo Excel
      $data = Excel::toArray([], $file)[0];

      // Procesar archivo csv
      // $data = array_map('str_getcsv', file($file));

      // $data ahora contiene un arreglo con las filas y columnas del archivo Excel
      return $data;
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


  public function tutorial() {
    return view('home.tutorial');
  }

  public function perfil() {
    $u = current_user();

    return view('admin.perfil',compact('u'));
  }

  public function perfilUpdate(Request $request) {
    $u = current_user();

    if ($request->pass) {
      $u->password = hash('sha256', $request->input('pass'));
      $u->update();
    }

    if ($request->nombre) {
      // $u->correo = $request->input('correo');
      $u->nombre = $request->input('nombre');
      $u->apellido_paterno = $request->input('apellido_p');
      $u->apellido_materno = $request->input('apellido_m');
      // $u->tipo_usuario = $request->input('admin') == 1 ? 1 : 2;
      $u->update();
    }

    return back()->with('success','Se ha actualizado');
  }
}

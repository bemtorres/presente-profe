<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Models\Semestre;
use App\Models\Sistema;
use App\Services\Imports\CalendarioImport;
use Illuminate\Http\Request;
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
    try {
      $calendario = (new CalendarioImport($request))->call();
      return back()->with('success','Se ha cargado correctamente');
      //code...
    } catch (\Throwable $th) {
      return $th;
      //throw $th;
    }
  }


  public function correo() {
    $s = Sistema::first();
    return view('admin.utils.correo' , compact('s') );
  }

  public function correoUpdate(Request $request) {
    $s = Sistema::first();

    $opc = $request->input('opcion');
    $info = $s->info;
    if ($opc == 1) {
      $info['send_email_solicitud'] = $request->input('s_solicitud') ? true : false ?? false;
      $info['send_email_cancelar'] = $request->input('s_cancelar') ? true : false ?? false;
      $info['send_email_aceptar'] = $request->input('s_aprobado') ? true : false ?? false;
      $info['send_email_rechazado'] = $request->input('s_rechazados') ? true : false ?? false;
    } else {
      $info['is_email_test'] = $request->input('s_email_test') ? true: false ?? false;
      $info['email_test'] = $request->input('email_test') ?? null;
    }
    $s->info = $info;
    $s->update();
    return back()->with('success','Se ha actualizado correctamente');
  }
}

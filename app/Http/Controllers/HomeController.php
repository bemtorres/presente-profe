<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\dh\Asignatura;
use App\Models\dh\AsociadoPlan;
use App\Models\Sistema;
use App\Models\Usuario;
use App\Services\CarrerasInformaticas;
use App\Services\DuocHorario;
use Auth;
use Illuminate\Http\Request;


// use App\Http\Requests\AuthLoginRequest as AuthRequest;

class HomeController extends Controller
{
  public function index() {

    $horarios = DuocHorario::TIMES;

    $planes_asociados = AsociadoPlan::where('id_usuario', current_user()->id)->with('plan')->get();

    return view('home.index', compact('horarios','planes_asociados'));
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


  public function run(Request $request) {
    $asignatura = Asignatura::where('sigla', CarrerasInformaticas::INFO_IMPARES[0][1])->first();

    if ($asignatura == null) {
      $asignaturas = CarrerasInformaticas::INFO_IMPARES;
      foreach ($asignaturas as $key => $as) {
        $a = new Asignatura();
        $a->programa = $as[0];
        $a->semestre   = $as[3];
        $a->nombre = $as[2];
        $a->sigla = $as[1];
        $a->save();
      }

      return "ok";
    }

    return "ya existe";
  }
}

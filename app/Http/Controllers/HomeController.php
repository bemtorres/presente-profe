<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Sistema;
use App\Models\Usuario;
use App\Services\DuocHorario;
use Auth;
use Illuminate\Http\Request;


// use App\Http\Requests\AuthLoginRequest as AuthRequest;

class HomeController extends Controller
{
  public function index() {

    $horarios = DuocHorario::TIMES;

    // return $horario;

    return view('home.index', compact('horarios'));
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalAsignatura;
use App\Models\RevisorSede;
use App\Models\Sede;
use App\Models\Usuario;
use App\Services\Policies\UsuarioPolicy;
use Illuminate\Http\Request;

class GlobalAsignaturaController extends Controller
{

  public function index() {
    $asignaturas = GlobalAsignatura::get();

    return view('admin.global_asignatura.index', compact('asignaturas'));
  }

}

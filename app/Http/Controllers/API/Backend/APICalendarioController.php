<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Models\Calendario;
use App\Models\RegistroCalendario;
use App\Models\Sede;
use App\Models\Usuario;
use App\Services\Policies\UsuarioPolicy;
use Illuminate\Http\Request;

class APICalendarioController extends Controller
{
  // private $policy;

  // public function __construct() {
  //   $this->policy = new UsuarioPolicy();
  // }

  public function buscar(Request $request) {
    // $this->policy->admin(current_user());
    $codigo = $request->input('codigo');
    $semana = $request->input('semana');
    $sala = $request->input('sala');


    $registro = RegistroCalendario::where('codigo', $codigo)
                                  ->where('semana', $semana)
                                  ->where('id_sala', $sala)
                                  ->get();

    $calendario = Calendario::where('codigo', $codigo)
                            ->where('semana', $semana)
                            ->where('id_sala', $sala)
                            ->get();

    return [
      'registro' => $registro,
      'calendario' => $calendario
    ];

    // return Response()->json([
    //   'message' => 'Se ha encontrado correctamente',
    //   'usuarios' => $usuariosEnRaw
    // ], 200);
  }

  public function store(Request $request) {
    $codigo = $request->input('codigo');
    $semana = $request->input('semana');
    $sala = $request->input('sala');

    // L, M, X, J, V, S
    $horarios = $request->input('horarios'); // array de registros a guardar [L2] LUNES MODULO 2

    foreach ($horarios as $keyh => $horario) {
      // $c = new Calendario();
      // $c->date = '';
      // $c->codigo = $codigo;
      // $c->semestre = ;
      // $c->modulo = '';
      // $c->semana = '';
      // $c->id_sede = '';
      // $c->id_sala = '';
      // $c->tipo = '';
      // $c->save();
    }

    return $request->all();
  }
}

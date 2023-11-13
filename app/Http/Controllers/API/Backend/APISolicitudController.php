<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Models\Calendario;
use App\Models\RegistroCalendario;
use App\Models\Sala;
use App\Models\Sede;
use App\Models\Semana;
use App\Models\Solicitud;
use App\Models\Usuario;
use App\Services\Policies\UsuarioPolicy;
use Illuminate\Http\Request;

class APISolicitudController extends Controller
{
  public function store(Request $request) {
    // return $request->all();

    $sala = $request->input('sala');
    $semana = $request->input('semana');
    $usuario = $request->input('usuario');
    $horarios = $request->input('horarios');
    $motivo = $request->input('motivo');
    $motivotext = $motivo == 100 ? $request->input('motivoInput') : null;

    $u = Usuario::findOrFail($usuario['id']);
    $s = Sala::with(['sede'])->findOrFail($sala['id']);
    $sede = $s->sede;

    // return $horarios;
    $solicitud = new Solicitud();
    $solicitud->id_sede = $sede->id;
    $solicitud->id_sala = $s->id;
    $solicitud->id_usuario = $u->id;
    $solicitud->motivo = $motivo;
    $solicitud->comentario = $motivotext;
    $solicitud->estado = 1;
    $solicitud->semana = $semana['semana']; // 2 - No es el id es la semana
    $solicitud->periodo = $semana['periodo'];
    $solicitud->save();

    foreach ($horarios as $hkey => $horario) {
      $dia_numero = array_flip(Calendario::DAYS)[$horario['dia']];

      $r = new RegistroCalendario();
      $r->fecha = date_format(date_create($horario['info']['fecha']),'Y-m-d');
      $r->periodo = $semana['periodo'];
      $r->semana = $semana['semana'];
      $r->dia = $dia_numero;
      $r->modulo = $horario['modulo'];
      $r->id_sede = $sede->id;
      $r->id_sala = $s->id;
      $r->id_usuario = $u->id;
      $r->id_solicitud = $solicitud->id;
      $r->estado = true;
      $r->save();
    }

    return response()->json([
      'solicitud' => $solicitud,
      'registros' => $solicitud->registros,
      'status' => 'success'
    ]);

  }
}

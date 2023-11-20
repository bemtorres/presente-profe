<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auditoria\AudRegistroCalendario;
use App\Models\Calendario;
use App\Models\RegistroCalendario;
use App\Models\Sala;
use App\Models\Solicitud;
use App\Models\Usuario;
use App\Services\EmailServices;
use Illuminate\Http\Request;

class APISolicitudController extends Controller
{
  public function store(Request $request) {
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
    $solicitud->id_semana = $semana['id_semana']; // ID de la semana ojo
    $solicitud->semana = $semana['semana']; // n° semana
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

    if (current_user()->user_app) {
      $ar = new AudRegistroCalendario();
      $ar->id_sede = $sede->id;
      $ar->id_solicitud = $solicitud->id;
      $ar->id_devise = current_user()->id;
      $ar->id_usuario = $u->id;
      $ar->tipo = 1;
      $ar->save();
    }

    $email = (new EmailServices($u->correo, [], $solicitud->id))->solicitud();

    return response()->json([
      'solicitud' => $solicitud,
      'registros' => $solicitud->registros,
      'status' => 'success'
    ]);

  }
}

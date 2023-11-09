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

    $solicitud = new Solicitud();
    $solicitud->id_sede = $sede->id;
    $solicitud->id_sala = $s->id;
    $solicitud->id_usuario = $u->id;
    $solicitud->motivo = $motivo;
    $solicitud->comentario = $motivotext;
    $solicitud->estado = 1;
    $solicitud->semana = $semana['semana'];
    $solicitud->periodo = $semana['periodo'];
    $solicitud->save();

    return response()->json([
      'solicitud' => $solicitud,
      'status' => 'success'
    ]);

    // foreach ($horarios as $hkey => $horario) {
    //   $dia_numero = array_flip(Calendario::DAYS)[$horario['dia']];

    //   $r = new RegistroCalendario();
    //   $r->fecha = $horario['info']['fecha'];
    //   $r->periodo = $semana['periodo'];
    //   $r->semana = $semana['semana'];
    //   $r->dia = $dia_numero;
    //   $r->modulo = $horario['modulo'];
    //   $r->id_sede = $sede->id;
    //   $r->id_sala = $sala['id'];
    //   $r->id_usuario = $u->id;
    //   $r->id_solicitud = $solicitud->id;
    //   $r->save();
      // $table->date('fecha')->nullable();
      // $table->string('periodo'); // "202302"
      // $table->integer('semana'); // 2
      // $table->integer('dia');    // 29
      // $table->integer('modulo'); // 1
      // $table->json('info')->nullable();

      // $table->foreignId('id_solicitud')->references('id')->on('solicitud');
      // $table->foreignId('id_sede')->references('id')->on('sede');
      // $table->foreignId('id_sala')->references('id')->on('sala');
      // $table->foreignId('id_usuario')->references('id')->on('usuario');

      // $table->integer('tipo')->default(0);
      // $table->integer('estado')->default(0);
      // $table->timestamps();
    // }


  }
}

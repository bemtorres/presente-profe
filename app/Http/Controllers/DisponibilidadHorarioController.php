<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\dh\Asignatura;
use App\Models\dh\AsignaturaPreferida;
use App\Models\dh\AsociadoPlan;
use App\Models\dh\HorarioPlan;
use App\Models\dh\Plan;
use App\Models\Sistema;
use App\Models\Usuario;
use App\Services\DuocHorario;
use Auth;
use Illuminate\Http\Request;


class DisponibilidadHorarioController extends Controller
{
  public function show($id) {
    $plan = Plan::findOrFail($id);
    $ap = AsociadoPlan::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->firstOrFail();

    $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->with('asignatura')->orderBy('posicion')->get();

    $has_horario = HorarioPlan::where('id_plan', $plan->id)->where('id_usuario', current_user()->id)->get()->count() > 0;

    return view('dh.show', compact('plan','ap','asignaturas_preferidas','has_horario'));
  }

  public function showPDF($id) {
    // solo el usuario puede ver su pdf
    $plan = Plan::with('asociado_plan')->findOrFail($id);
    $asociado = AsociadoPlan::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->firstOrFail();
    $u = $asociado->usuario;
    return view('dh.pdf', compact('plan','asociado','u'));
  }

  public function asignaturas($id) {
    $plan = Plan::findOrFail($id);
    $ap = AsociadoPlan::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->firstOrFail();

    $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->with('asignatura')->orderBy('posicion')->get();

    return view('dh.asignaturas.index', compact('plan','ap','asignaturas_preferidas'));
  }

  public function asignaturasPDF($id, $id_asignatura) {
    $plan = Plan::findOrFail($id);
    $ap = AsociadoPlan::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->firstOrFail();
    $a = Asignatura::findOrFail($id_asignatura);

    return view('dh.asignaturas.pdf', compact('plan','ap','a'));
  }


  public function mis_asignaturas($id) {
    $plan = Plan::findOrFail($id);
    $ap = AsociadoPlan::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->firstOrFail();

    $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->with('asignatura')->orderBy('posicion')->get();

    return view('dh.asignaturas.me', compact('plan','ap','asignaturas_preferidas'));
  }

  public function asignaturasCreate($id) {
    $plan = Plan::with('detalle_plan')->findOrFail($id);
    $ap = AsociadoPlan::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->firstOrFail();

    $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->with('asignatura')->get();

    foreach ($plan->detalle_plan as $dp) {
      $dp->selected = false;
      foreach ($asignaturas_preferidas as $aap) {
        if ($dp->id_asignatura == $aap->id_asignatura) {
          $dp->selected = true;
        }
      }
    }

    return view('dh.asignaturas.create', compact('plan','ap'));
  }

  public function asignaturasStore(Request $request, $id) {
    return $this->_asignaturasStore($request, $id, current_user()->id);
  }

  public function asignaturasStoreMain(Request $request, $id, $id_usuario) {
    return $this->_asignaturasStore($request, $id, $id_usuario);
  }

  private function _asignaturasStore(Request $request, $id, $id_usuario) {
    try {
      $plan = Plan::with('detalle_plan')->findOrFail($id);
      $ap = AsociadoPlan::where('id_usuario', $id_usuario)->where('id_plan', $plan->id)->firstOrFail();

      $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', $id_usuario)->where('id_plan', $plan->id)->with('asignatura')->get();

      $asignaturas_ids = $request->input('asignaturas_ids');

      foreach ($plan->detalle_plan as $dp) {
        $dp->selected = false;
        foreach ($asignaturas_preferidas as $ap) {
          if ($dp->id_asignatura == $ap->id_asignatura) {
            $dp->selected = true;
          }
        }

        $dp->form = false;
        if($asignaturas_ids) {
          foreach ($asignaturas_ids as $p => $id) {
            if ($dp->id_asignatura == $id) {
              $dp->form = true;
            }
          }
        }
      }

      $n = AsignaturaPreferida::where('id_usuario', $id_usuario)->where('id_plan', $plan->id)->count() + 1;

      foreach ($plan->detalle_plan as $asig) {
        if (!$asig->selected && $asig->form) { //nuevo
          $ap = new AsignaturaPreferida();
          $ap->id_plan = $plan->id;
          $ap->id_asignatura = $asig->id_asignatura;
          $ap->id_usuario = $id_usuario;
          $ap->posicion = $n;
          $ap->save();

          $n = $n + 1;
        } elseif ($asig->selected && !$asig->form) {
          $ap = AsignaturaPreferida::where('id_usuario', $id_usuario)
                                  ->where('id_plan',$plan->id)
                                  ->where('id_asignatura',$asig->id_asignatura)
                                  ->first();
          $ap->delete();
        }
      }
      return back()->with('success','Se ha actualizado.');
    } catch (\Throwable $th) {
      return back()->with('info','Error Intente nuevamente.');
    }
  }


  public function calendario($id) {
    $plan = Plan::findOrFail($id);
    $ap = AsociadoPlan::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->firstOrFail();
    $mis_horarios = HorarioPlan::where('id_plan', $plan->id)->where('id_usuario', current_user()->id)->get();

    $my_horario = [];
    if ($mis_horarios->count() != 0) {
      $my_horario = $mis_horarios->map(function ($horario) {
        return $horario->to_raw();
      });
    }

    $horarios = DuocHorario::TIMES;

    return view('dh.calendario.index', compact('plan','ap','horarios','my_horario'));
  }

  // @api INTERNA
  public function apiAsignaturaChangePosition(Request $request, $id) {
    $id_usuario = current_user()->id;
    return $this->_apiAsignaturaChangePosition($request, $id, $id_usuario);
  }

  public function apiAsignaturaChangePositionMain(Request $request, $id, $id_usuario) {
    return $this->_apiAsignaturaChangePosition($request, $id, $id_usuario);
  }

  private function _apiAsignaturaChangePosition(Request $request, $id, $id_usuario) {
    try {
      $plan = Plan::with('detalle_plan')->findOrFail($id);

      $id = $request->input('code');
      $posiciones = $request->input('list');

      $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', $id_usuario)->where('id_plan', $plan->id)->with('asignatura')->get();

      foreach ($asignaturas_preferidas as $ap) {
        for ($i=0; $i < count($posiciones); $i++) {
          if($ap->id == $posiciones[$i] && $ap->posicion != ($i + 1)){
            $ap->posicion = $i + 1;
            $ap->update();
          }
        }
      }

      return response()->json(['message' => 'Se ha actualizado.'], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => 'Error. Intente nuevamente'], 400);
    }
  }

  public function apiAsignaturaStore(Request $request, $id) {
    $user_id = current_user()->id;
    return $this->_apiAsignaturaStore($request, $id, $user_id);
  }

  public function apiAsignaturaStoreMain(Request $request, $id, $id_usuario) {
    return $this->_apiAsignaturaStore($request, $id, $id_usuario);
  }

  // PRIVATE
  private function _apiAsignaturaStore(Request $request, $id, $user_id) {
    try {
      $plan = Plan::findOrFail($id);
      $ap = AsociadoPlan::where('id_usuario', $user_id)
                        ->where('id_plan', $plan->id)->firstOrFail();
      $my_horarios = HorarioPlan::where('id_plan', $plan->id)->where('id_usuario', $user_id)->get();

      $in_calendario = $request->input('calendario');


      if ($my_horarios->count() == 0) { // VÁCIO
        foreach ($in_calendario as $key => $value) {
          $dia = array_flip(HorarioPlan::DAYS)[$value['dia']];

          $horario = new HorarioPlan();
          $horario->id_plan = $plan->id;
          $horario->id_usuario = $user_id;
          $horario->dia = $dia;
          $horario->modulo = $value['modulo'];
          $horario->estado = $value['estado'];
          $horario->save();
        }
      } else {
        foreach ($in_calendario as $key => $value) {
          $in_calendario[$key]['encontado'] = false;
        }

        foreach ($my_horarios as $mh) {
          $raw = $mh->to_raw();
          $encontrado = false;

          foreach ($in_calendario as $key => $value) {
            if ($raw['dia'] == $value['dia'] && $mh->modulo == $value['modulo']) {
              $encontrado = true;
              $mh->estado = $value['estado'];
              $mh->update();
              $in_calendario[$key]['encontado'] = true;
              break;
            }
          }

          if (!$encontrado) {
            $mh->delete();
          }
        }

        foreach ($in_calendario as $key => $value) {
          if (!$value['encontado']) {
            $dia = array_flip(HorarioPlan::DAYS)[$value['dia']];

            $horario = new HorarioPlan();
            $horario->id_plan = $plan->id;
            $horario->id_usuario = $user_id;
            $horario->dia = $dia;
            $horario->modulo = $value['modulo'];
            $horario->estado = $value['estado'];
            $horario->save();
          }
        }
      }

      return response()->json(['message' => 'Se ha actualizado.', 'status' => 200], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => 'error intente nuevamente.', 'status' => 500], 500);
    }
  }
}

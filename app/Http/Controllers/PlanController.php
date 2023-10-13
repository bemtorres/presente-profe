<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Models\dh\Asignatura;
use App\Models\dh\AsignaturaPreferida;
use App\Models\dh\AsociadoPlan;
use App\Models\dh\DetallePlan;
use App\Models\dh\HorarioPlan;
use App\Models\dh\Plan;
use App\Models\Usuario;
use App\Services\DuocHorario;
use App\Services\Policies\PlanePolicy;
use Illuminate\Http\Request;

class PlanController extends Controller
{
  private $policy;

  public function __construct() {
    $this->policy = new PlanePolicy();
  }

  public function index() {
    $this->policy->index(current_user());

    $planes = Plan::where('id_usuario', current_user()->id)->get();

    return view('planes.index', compact('planes'));
  }

  public function create() {
    return view('planes.create');
  }

  public function store(Request $request) {
    $this->policy->store(current_user());

    $p = new Plan();
    $p->nombre = $request->input('nombre');
    $p->descripcion = $request->input('descripcion');
    $p->id_usuario = current_user()->id;
    $p->estado = 1;
    $p->save();

    return redirect()->route('planes.index')->with('success','Se ha creado correctamente');
  }

  public function show($id) {
    $this->policy->show(current_user());

    $plan = Plan::where('id_usuario', current_user()->id)->with('detalle_plan')->findOrFail($id);

    return view('planes.show', compact('plan'));
  }

  public function edit($id) {
    $this->policy->edit(current_user());

    $plan = Plan::where('id_usuario', current_user()->id)->findOrFail($id);
    $estados = Plan::ESTADOS;

    return view('planes.edit', compact('plan','estados'));
  }

  public function update(Request $request, $id) {
    $p = Plan::where('id_usuario', current_user()->id)->findOrFail($id);
    $p->nombre = $request->input('nombre');
    $p->descripcion = $request->input('descripcion');
    // $p->id_usuario = current_user()->id;
    $p->estado = $request->input('estado');
    // $p->estado = 0;
    // $p->codigo =
    $p->update();
    // return view('planes.edit', compact('plan'));
    return back()->with('success','Se ha actualizado correctamente');
  }


  public function participantes($id) {
    $this->policy->participantes(current_user());

    $plan = Plan::where('id_usuario', current_user()->id)->with('asociado_plan')->findOrFail($id);

    $asociados = $plan->asociado_plan;

    foreach ($asociados as $key => $asociado) {
      $u_id = $asociado->id_usuario;

      $asociado['has_asignaturas'] = AsignaturaPreferida::where('id_usuario', $u_id)->where('id_plan', $plan->id)->get()->count() > 0;
      $asociado['has_horario'] = HorarioPlan::where('id_plan', $plan->id)->where('id_usuario', $u_id)->get()->count() > 0;
    }

    return view('planes.id.participantes', compact('plan'));
  }

  public function participantesAdd($id) {
    $plan = Plan::where('id_usuario', current_user()->id)->with('asociado_plan')->findOrFail($id);
    $usuarios = Usuario::get();

    foreach ($usuarios as $u) {
      $u->selected = false;
      foreach ($plan->asociado_plan as $dp) {
        if ($u->id == $dp->id_usuario) {
          $u->selected = true;
        }
      }
    }

    return view('planes.id.inscribir', compact('usuarios','plan'));
  }

  public function participantesUpdate(Request $request, $id) {
    try {
      $plan = Plan::where('id_usuario', current_user()->id)->with('asociado_plan')->findOrFail($id);
      $usuarios = Usuario::get();
      $participantes_ids = $request->input('data_ids');

      foreach ($usuarios as $u) {
        $u->selected = false;
        foreach ($plan->asociado_plan as $dp) {
          if ($u->id == $dp->id_usuario) {
            $u->selected = true;
          }
        }
        $u->form = false;
        if($participantes_ids) {
          foreach ($participantes_ids as $p => $id) {
            if ($u->id == $id) {
              $u->form = true;
            }
          }
        }
      }

      foreach ($usuarios as $user) {
        if (!$user->selected && $user->form) { //nuevo
          $ap = new AsociadoPlan();
          $ap->id_plan = $plan->id;
          $ap->id_usuario = $user->id;
          $ap->save();

        } elseif ($user->selected && !$user->form) {
          $ap = AsociadoPlan::where('id_plan',$plan->id)->where('id_usuario',$user->id)->first();
          $ap->delete();
        }
      }
      return back()->with('success','Se ha actualizado.');
    } catch (\Throwable $th) {
      return $th;
      return back()->with('info','Error Intente nuevamente.');
    }
  }

  public function participantesShow($id, $id_asociado) {
    $plan = Plan::where('id_usuario', current_user()->id)->with('asociado_plan')->findOrFail($id);
    $asociado = AsociadoPlan::where('id_plan',$plan->id)->with('usuario')->findOrFail($id_asociado);
    $u = $asociado->usuario;

    // reporte 1
    $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', $u->id)->where('id_plan', $plan->id)->with('asignatura')->orderBy('posicion')->get();

    // reporte 2
    $mis_horarios = HorarioPlan::where('id_plan', $plan->id)->where('id_usuario', $u->id)->get();

    $my_horario = [];
    if ($mis_horarios->count() != 0) {
      $my_horario = $mis_horarios->map(function ($horario) {
        return $horario->to_raw();
      });
    }

    $horarios = DuocHorario::TIMES;

    return view('planes.id.participantes.show', compact('plan','asociado','u', 'asignaturas_preferidas','my_horario','horarios'));
  }

  public function participantesAsignatura($id, $id_asociado) {
    $plan = Plan::with('asociado_plan')->findOrFail($id);
    $asociado = AsociadoPlan::where('id_plan',$plan->id)->with('usuario')->findOrFail($id_asociado);
    $u = $asociado->usuario;

    $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', $u->id)->where('id_plan', $plan->id)->with('asignatura')->orderBy('posicion')->get();

    return view('planes.id.participantes.asignaturas', compact('plan','asociado','u', 'asignaturas_preferidas'));
  }

  public function participantesAsignaturaCreate($id, $id_asociado) {

    $plan = Plan::with('detalle_plan')->findOrFail($id);
    $ap = AsociadoPlan::where('id_plan', $plan->id)->findOrFail($id_asociado);
    $u = $ap->usuario;

    $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', $u->id)->where('id_plan', $plan->id)->with('asignatura')->get();

    foreach ($plan->detalle_plan as $dp) {
      $dp->selected = false;
      foreach ($asignaturas_preferidas as $aap) {
        if ($dp->id_asignatura == $aap->id_asignatura) {
          $dp->selected = true;
        }
      }
    }

    return view('planes.id.participantes.asignatura_add', compact('plan','ap', 'u'));
  }

  public function participantesAsignaturaStore($id, $id_asociado) {
    $plan = Plan::with('asociado_plan')->findOrFail($id);
    $asociado = AsociadoPlan::where('id_plan',$plan->id)->with('usuario')->findOrFail($id_asociado);
    $u = $asociado->usuario;

    $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', $u->id)->where('id_plan', $plan->id)->with('asignatura')->orderBy('posicion')->get();

    return view('planes.id.participantes.asignaturas', compact('plan','asociado','u', 'asignaturas_preferidas'));
  }


  public function participantesShowPDF($id, $id_asociado) {
    $plan = Plan::where('id_usuario', current_user()->id)->with('asociado_plan')->findOrFail($id);
    $asociado = AsociadoPlan::where('id_plan',$plan->id)->with('usuario')->findOrFail($id_asociado);
    $u = $asociado->usuario;


    return view('planes.id.participantes.pdf', compact('plan','asociado', 'u'));
  }

  public function showPDF($id) {
    $this->policy->show(current_user());

    $plan = Plan::where('id_usuario', current_user()->id)->with('asociado_plan')->findOrFail($id);

    return view('planes.id.reporte.general_pdf', compact('plan'));
  }

  // public function compartir($id) {
  //   $plan = Plan::where('id_usuario', current_user()->id)->findOrFail($id);

  //   return view('planes.id.compartir', compact('plan'));
  // }

  public function asignaturas($id) {
    $plan = Plan::where('id_usuario', current_user()->id)->with('detalle_plan')->findOrFail($id);
    return view('planes.id.asignaturas', compact('plan'));
  }

  public function asignaturasAdd($id) {
    $plan = Plan::where('id_usuario', current_user()->id)->with('detalle_plan')->findOrFail($id);
    $asignaturas = Asignatura::get();


    foreach ($asignaturas as $a) {
      $a->selected = false;
      foreach ($plan->detalle_plan as $dp) {
        if ($a->id == $dp->id_asignatura) {
          $a->selected = true;
        }
      }
    }

    return view('planes.id.asignaturasAdd', compact('plan','asignaturas'));
  }

  public function asignaturasUpdate(Request $request, $id) {
    try {
      $plan = Plan::where('id_usuario', current_user()->id)->with('detalle_plan')->findOrFail($id);
      $asignaturas = Asignatura::get();
      $asignaturas_ids = $request->input('asignaturas_ids');

      foreach ($asignaturas as $a) {
        $a->selected = false;
        foreach ($plan->detalle_plan as $dp) {
          if ($a->id == $dp->id_asignatura) {
            $a->selected = true;
          }
        }

        $a->form = false;
        if($asignaturas_ids) {
          foreach ($asignaturas_ids as $p => $id) {
            if ($a->id == $id) {
              $a->form = true;
            }
          }
        }
      }


      $n = DetallePlan::where('id_plan',$plan->id)->count() + 1;


      foreach ($asignaturas as $asig) {
        if (!$asig->selected && $asig->form) { //nuevo
          $dp = new DetallePlan();
          $dp->id_plan = $plan->id;
          $dp->id_asignatura = $asig->id;
          $dp->posicion = $n;
          $dp->save();

          $n = $n + 1;
        } elseif ($asig->selected && !$asig->form) {
          $dp = DetallePlan::where('id_plan',$plan->id)->where('id_asignatura',$asig->id)->first();
          $dp->delete();
        }
      }
      return back()->with('success','Se ha actualizado.');
    } catch (\Throwable $th) {

      return $th;
      return back()->with('info','Error Intente nuevamente.');
    }
  }

  public function reporte($id) {
    $plan = Plan::with(['detalle_plan','users_asignaturas'])->findOrFail($id);

    $users_asignaturas =$plan->users_asignaturas;

    // return $users_asignaturas;

    return view('planes.id.reporte.index', compact('plan','users_asignaturas'));
  }

  public function reporteListado($id) {
    $plan = Plan::with(['detalle_plan','users_asignaturas'])->findOrFail($id);

    $horarios = HorarioPlan::where('id_plan', $plan->id)->with('usuario')->get();
    // $users_asignaturas =$plan->users_asignaturas;

    // return $users_asignaturas;


    return view('planes.id.reporte.listado', compact('plan','horarios'));
  }

  public function reporteAsignatura($id) {
    $plan = Plan::with(['detalle_plan','users_asignaturas'])->findOrFail($id);
    $users_asignaturas =$plan->users_asignaturas;

    // return $users_asignaturas;


    return view('planes.id.reporte.asignaturas', compact('plan','users_asignaturas'));
  }

  public function exportReporteListado($id) {
    $plan = Plan::with(['detalle_plan','users_asignaturas'])->findOrFail($id);

    // return $plan;
    return (new ReportExport($id))->download();
  }



  // @api INTERNA
  public function apiAsignaturaChangePosition(Request $request, $id) {
    try {
      $id = $request->input('code');
      $posiciones = $request->input('list');

      $detalles_planes =  DetallePlan::where('id_plan',$id)->orderBy('posicion')->get();

      foreach ($detalles_planes as $dp) {
        for ($i=0; $i < count($posiciones); $i++) {
          if($dp->id == $posiciones[$i] && $dp->posicion != ($i + 1)){
            $dp->posicion = $i + 1;
            $dp->update();
          }
        }
      }

      return response()->json(['message' => 'Se ha actualizado.'], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => 'Error. Intente nuevamente'], 400);
    }
  }
}

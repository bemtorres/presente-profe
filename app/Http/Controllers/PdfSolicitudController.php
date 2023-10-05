<?php

namespace App\Http\Controllers;

use App\Models\dh\AsignaturaPreferida;
use App\Models\dh\AsociadoPlan;
use App\Models\dh\HorarioPlan;
use App\Models\dh\Plan;
use App\Models\Usuario;
use App\Services\CelendarioDisponibilidadH;
use App\Services\DuocHorario;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;

class PdfSolicitudController extends Controller
{

  public function uno() {
    $data = "informacion";

    $pdf = Pdf::loadView('pdf.uno',compact('data'));
    // $pdf2 = Pdf::loadView('pdf.uno',compact(''));

    // $pdf->getDomPDF()->addPage($pdf2->getDomPDF()->output());


    // $pdf1->getDomPDF()->addPage($pdf2->getDomPDF()->output());
    // return $pdf1->stream('facturas_combinadas.pdf');


    return $pdf->stream("nuevo.pdf");
  }

  public function disponibilidad_personal($plan_id, $asociado_id) {
    $plan = Plan::with('asociado_plan')->findOrFail($plan_id);
    $asociado = AsociadoPlan::where('id_usuario', current_user()->id)->where('id_plan', $plan->id)->findOrFail($asociado_id);
    $u = $asociado->usuario;

    // reporte 1
    $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', $u->id)->where('id_plan', $plan->id)->with('asignatura')->orderBy('posicion')->get();

    // reporte 2
    $horarios = DuocHorario::TIMES;
    $calendario = (new CelendarioDisponibilidadH($plan->id, $asociado->id))->call();

    $pdf = Pdf::loadView('pdf.diponibilidad_pdf',compact('u','calendario','asignaturas_preferidas','horarios'));
    return $pdf->stream("DH_".str_replace(' ','_',$u->nombre_completo()).".pdf");
  }

  public function disponibilidad($plan_id, $asociado_id) {
    $plan = Plan::where('id_usuario', current_user()->id)->with('asociado_plan')->findOrFail($plan_id);
    $asociado = AsociadoPlan::where('id_plan',$plan->id)->with('usuario')->findOrFail($asociado_id);
    $u = $asociado->usuario;

    // reporte 1
    $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', $u->id)->where('id_plan', $plan->id)->with('asignatura')->orderBy('posicion')->get();

    // reporte 2
    $horarios = DuocHorario::TIMES;
    $calendario = (new CelendarioDisponibilidadH($plan->id, $asociado->id))->call();

    $pdf = Pdf::loadView('pdf.diponibilidad_pdf',compact('u','calendario','asignaturas_preferidas','horarios'));
    return $pdf->stream("DH_".str_replace(' ','_',$u->nombre_completo()).".pdf");
  }

  public function disponibilidad_general($plan_id) {
    try {
      $plan = Plan::where('id_usuario', current_user()->id)->with('asociado_plan')->findOrFail($plan_id);

      $data = [];

      foreach ($plan->asociado_plan as $a) {
        $asociado = AsociadoPlan::where('id_plan',$plan->id)->with('usuario')->findOrFail($a->id);
        $u = $asociado->usuario;

        // reporte 1
        $asignaturas_preferidas = AsignaturaPreferida::where('id_usuario', $u->id)->where('id_plan', $plan->id)->with('asignatura')->orderBy('posicion')->get();

        // reporte 2
        $horarios = DuocHorario::TIMES;
        $calendario = (new CelendarioDisponibilidadH($plan->id, $asociado->id))->call();

        $data[] = [
          'u' => $u,
          'calendario' => $calendario,
          'asignaturas_preferidas' => $asignaturas_preferidas,
          'horarios' => $horarios
        ];
      }


      $pdf = Pdf::loadView('pdf.diponibilidad_general_pdf',compact('data','plan'));
      // $pdf = Pdf::loadView('pdf.diponibilidad_pdf',compact('u','calendario','asignaturas_preferidas','horarios'));
      return $pdf->stream("DH_".str_replace(' ','_',$plan->nombre).".pdf");
    } catch (\Throwable $th) {
      //throw $th;
      return $th;
    }
  }

}

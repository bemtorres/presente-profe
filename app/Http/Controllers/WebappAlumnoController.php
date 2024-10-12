<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AsistenciaEspacio;
use App\Models\ClaseEspacio;
use App\Models\Espacio;
use App\Models\MatriculaEspacio;
use App\Models\ReporteInasistencia;
use Illuminate\Http\Request;

class WebappAlumnoController extends Controller
{
  public function index() {
    $matriculas = MatriculaEspacio::where('id_estudiante', current_user()->id)->get();

    return view('webapp_alumno.index', compact('matriculas'));
  }

  public function matriculaStore(Request $request) {
    $request->validate([
      'code' => 'required',
    ]);

    $e = Espacio::where('codigo_matricula', $request->input('code'))->first();

    if (empty($e)) {
      return back()->with('info', 'Código de matrícula incorrecto');
    }

    $matricula = MatriculaEspacio::where('id_estudiante', current_user()->id)->where('id_espacio', $e->id)->first();

    if (!empty($matricula)) {
      return back()->with('info', 'Ya te encuentras matriculado en este espacio');
    }

    $matricula = new MatriculaEspacio();
    $matricula->id_estudiante = current_user()->id;
    $matricula->id_espacio = $e->id;
    $matricula->habilitado = 1;
    $matricula->activo = true;
    $matricula->save();

    return back()->with('success', 'Matrícula realizada con éxito');
  }


  public function registroStore(Request $request) {
    $codigo = $request->input('codigoQR');

    $clase = ClaseEspacio::where('codigo_web', $codigo)->first();

    if (empty($clase)) {
      return back()->with('info', 'Código de clase incorrecto');
    }

    $matricula = MatriculaEspacio::where('id_estudiante', current_user()->id)->where('id_espacio', $clase->espacio->id)->first();

    if (empty($matricula)) {
      // return back()->with('info', 'No estás matriculado en este espacio');
      $matricula = new MatriculaEspacio();
      $matricula->id_estudiante = current_user()->id;
      $matricula->id_espacio = $clase->id_espacio;
      $matricula->habilitado = 1;
      $matricula->activo = true;
      $matricula->save();
    }

    $asistencia = AsistenciaEspacio::where('id_clase_espacio', $clase->id)
                                  ->where('id_matricula_espacio', $matricula->id)
                                  ->first();

    if (!empty($asistencia)) {
      return back()->with('info', 'Ya has registrado tu asistencia');
    }

    $asistencia = new AsistenciaEspacio();
    $asistencia->fecha = date('Y-m-d');
    $asistencia->run = current_user()->run;
    $asistencia->id_clase_espacio = $clase->id;
    $asistencia->id_matricula_espacio = $matricula->id;
    $asistencia->save();


    return back()->with('success', 'Asistencia registrada con éxito');
  }


  public function reporteStore(Request $request) {
    $mensaje = $request->input('modal_mensaje');
    $fecha = $request->input('modal_fecha');
    $id_matricula = $request->input('modal_id_matricula');

    $matricula = MatriculaEspacio::where('id_estudiante', current_user()->id)->where('id', $id_matricula)->first();

    $reporte = new ReporteInasistencia();
    $reporte->fecha_inicio = $fecha;
    $reporte->mensaje = $mensaje;
    $reporte->id_matricula_espacio = $matricula->id;
    $reporte->save();

    return back()->with('success', 'Reporte enviado con éxito');
  }

  public function historial($id) {
    $m = MatriculaEspacio::with('asistencias','reportes')->where('id_estudiante', current_user()->id)->where('id', $id)->first();

    $e = $m->espacio;

    return view('webapp_alumno.historial', compact('m','e'));
  }
}

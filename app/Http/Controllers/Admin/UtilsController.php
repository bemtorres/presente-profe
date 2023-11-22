<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Models\Semestre;
use App\Models\Sistema;
use App\Models\Usuario;
use App\Services\Imports\CalendarioImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class UtilsController extends Controller
{

  public $numero = 1;

  public function index() {
    return view('admin.utils.index');
  }

  public function calendario() {
    $sedes = Sede::orderBy('nombre')->get();
    $semestres = Semestre::get();
    return view('admin.utils.import.calendario', compact('sedes','semestres'));
  }

  public function calendarioStore(Request $request) {
    try {
      $calendario = (new CalendarioImport($request))->call();

      // return $calendario;
      return back()->with('success','Se ha cargado correctamente');
      //code...
    } catch (\Throwable $th) {
      return $th;
      // return back()->
      //throw $th;
    }
  }


  public function usuarios() {
    $sedes = Sede::orderBy('nombre')->get();

    return view('admin.utils.import.usuarios', compact('sedes'));
  }

  public function usuariosStore(Request $request) {
    try {
      if ($request->hasFile('excel_file')) {
        $file = $request->file('excel_file');
        $data = Excel::toArray([], $file)[0];

        $array_usuarios = [];

        // return $data;

        $array_correos = [];

        foreach ($data as $key => $v) {
          if ($key > 0 && $v[4] != null) {
            $usuario = [
              'run' => strtoupper($v[0]) ?? null,
              'nombre' => ucfirst(trim($v[1])),
              'apellido_paterno' => ucfirst(trim($v[2])),
              'apellido_materno' => ucfirst(trim($v[3])),
              'correo' => strtolower(trim($v[4])),
              'password' => hash('sha256', $v[5] ?? time()),
              'id_sede' => $request->input('sede'),
              'tipo_usuario' => 2,
            ];

            $array_usuarios[] = $usuario;
            $array_correos[] = strtolower(trim($v[4]));
          }
        }

        $correos = array_column($array_usuarios, 'correo');

        // Obtener correos únicos
        $correosUnicos = array_unique($correos);

        // Obtener usuarios existentes
        $usuarios_existentes = Usuario::whereIn('correo', $array_correos)->pluck('correo');
        // Crear un nuevo arreglo solo con usuarios únicos
        $usuariosUnicos = [];
        foreach ($array_usuarios as $usuario) {
            if (in_array($usuario['correo'], $correosUnicos) && !in_array($usuario['correo'], $usuarios_existentes->toArray())) {
                $usuariosUnicos[] = $usuario;
                // Eliminar el correo de la lista de únicos para evitar duplicados
                unset($correosUnicos[array_search($usuario['correo'], $correosUnicos)]);
            }
        }

        // Reindexar el nuevo arreglo
        $usuariosUnicos = array_values($usuariosUnicos);

        if (count($usuariosUnicos) > 0) {
          Usuario::insert($usuariosUnicos);
        }

        return back()->with('success','Se ha cargado correctamente');
      }
    } catch (\Throwable $th) {
      return back()->with('error','Ha ocurrido un error');
    }
  }


  public function correo() {
    $s = Sistema::first();
    return view('admin.utils.correo' , compact('s') );
  }

  public function correoUpdate(Request $request) {
    $s = Sistema::first();

    $opc = $request->input('opcion');
    $info = $s->info;
    if ($opc == 1) {
      $info['send_email_solicitud'] = $request->input('s_solicitud') ? true : false ?? false;
      $info['send_email_cancelar'] = $request->input('s_cancelar') ? true : false ?? false;
      $info['send_email_aceptar'] = $request->input('s_aprobado') ? true : false ?? false;
      $info['send_email_rechazado'] = $request->input('s_rechazados') ? true : false ?? false;
    } else {
      $info['is_email_test'] = $request->input('s_email_test') ? true: false ?? false;
      $info['email_test'] = $request->input('email_test') ?? null;
    }
    $s->info = $info;
    $s->update();
    return back()->with('success','Se ha actualizado correctamente');
  }
}

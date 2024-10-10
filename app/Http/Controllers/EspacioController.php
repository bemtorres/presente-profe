<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClaseEspacio;
use App\Models\Espacio;
use App\Models\Usuario;
use App\Services\ImportImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EspacioController extends Controller
{
  public function index() {
    $espacios = Espacio::where('id_usuario', current_user()->id)->get();

    return view('admin.espacio.index', compact('espacios'));
  }

  public function create() {
    return view('admin.espacio.create');
  }

  public function store(Request $request) {
    try {
      $e = new Espacio();
      $e->id_usuario = current_user()->id;
      $e->nombre = $request->input('nombre');
      $e->sigla = Str::upper($request->input('sigla'));
      // $e->periodo = $request->input('periodo');
      $e->periodo = '01-2024';
      $e->descripcion = $request->input('descripcion');
      $e->institucion = $request->input('institucion');
      $e->codigo_unirse = $this->findCodigoUpdate('codigo_unirse');
      $e->codigo_matricula = $this->findCodigoUpdate('codigo_matricula');

      if(!empty($request->file('image'))){
        $request->validate([
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $filename = time() . '-' . Str::random(3);
        $folder = 'public/assets/espacios/';
        $e->imagen = ImportImage::save($request, 'image', $filename, $folder);
      }

      $e->save();
      return redirect()->route('admin.espacio.index')->with('success', 'Usuario creado correctamente');
    } catch (\Throwable $th) {
      return $th;
      return back()->with('error', 'Error al crear el usuario');
    }
  }

  public function show($id) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    return view('admin.espacio.show', compact('e'));
  }

  public function edit($id) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    return view('admin.espacio.edit', compact('e'));
  }

  public function compartir($id) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    return view('admin.espacio.compartir', compact('e'));
  }

  public function matricula($id) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    return view('admin.espacio.matricula', compact('e'));
  }

  public function clases($id) {
    $e = Espacio::with('clases')->where('id_usuario', current_user()->id)->find($id);
    $fechaHoraActual = Carbon::now()->format('Y-m-d\TH:i');


    $calendario = $this->getCalendario($e);

    // return $calendario;
    return view('admin.espacio.clases', compact('e', 'fechaHoraActual', 'calendario'));
  }

  private function getCalendario(Espacio $e) {
    $calendario = array();

    foreach ($e->clases as $c) {
      $color = $c->activo ? '#00a65a' : '#000000';
      $a = array(
        'title' => $c->getDate()->getDateFormatEmail() ?? 'Sin Nombre',
        // 'start' => $c->getDate()->getDate() . ' ' . $c->getDate()->getTime(),
        'start' => $c->fecha,
        'backgroundColor' => $color,
        'borderColor' => $color,
        'url' => route('admin.espacio.clases.show',[$e->id,$c->id]),
      );
      array_push($calendario,$a);
    }
    return $calendario;
  }

  public function clasesStore($id, Request $request) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    $fechaHora = $request->input('fechaHora');

    $clase = new ClaseEspacio();
    $clase->fecha = $fechaHora;
    $clase->id_espacio = $e->id;
    $clase->id_usuario = current_user()->id;
    $clase->info = json_encode($request->input('info'));
    $clase->codigo_web = $this->findCodigoClaseUpdate('codigo_web');
    $clase->activo = false;
    $clase->save();

    return redirect()->route('admin.espacio.clases', $e->id)->with('success', 'Clase creada correctamente');
  }

  public function clasesUpdate($id, Request $request) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    $fechaHora = $request->input('fechaHora');

    $clase = ClaseEspacio::where('id_usuario', current_user()->id)->find($id);
    $clase->fecha = $fechaHora;
    $clase->id_espacio = $e->id;
    $clase->info = json_encode($request->input('info'));
    $clase->codigo_web = $this->findCodigoClaseUpdate('codigo_web');
    $clase->save();

    return view('admin.espacio.clases', compact('e', 'fechaHoraActual'));
  }


  public function clasesCodeChange($id) {
    $clase = ClaseEspacio::where('id_usuario', current_user()->id)->find($id);
    $clase->codigo_web = $this->findCodigoClaseUpdate('codigo_web');
    $clase->update();

    return back()->with('success', 'Código de clase actualizado correctamente');
  }


  // public function update(Request $request, $id) {
  //   $u = Usuario::find($id);
  //   $u->run = $request->input('run');
  //   $u->nombre = $request->input('nombre');
  //   $u->apellido_paterno = $request->input('apellido_paterno');
  //   $u->apellido_materno = $request->input('apellido_materno');
  //   $u->correo = $request->input('correo');
  //   $u->admin = empty($request->input('check-admin')) ? false : true;
  //   $u->premium = empty($request->input('check-premium')) ? false : true;
  //   $u->update();
  //   return back()->with('success', 'Usuario actualizado correctamente');
  // }

  // public function updatePassword(Request $request, $id) {
  //   $u = Usuario::find($id);
  //   $u->password = hash('sha256', $request->pass);
  //   $u->update();
  //   return back()->with('success', 'Usuario actualizado correctamente');
  // }


  // API INTERNA
  public function matriculaActive($id) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    $e->matricula_activo = !$e->matricula_activo;
    $e->update();

    // return json 200
    return response()->json(['registro_activo' => $e->matricula_activo]);
  }


  // PRIVATE

  private function findCodigoUpdate($column, $max = 6) {
    $codigo =  "";
    $existe = true;
    while ($existe) {
      $codigo =  Str::random($max);
      $existe = Espacio::where($column, $codigo)->first();
    }

    return $codigo;
  }

  private function findCodigoClaseUpdate($column, $max = 6) {
    $codigo =  "";
    $existe = true;
    while ($existe) {
      $codigo =  Str::random($max);
      $existe = ClaseEspacio::where($column, $codigo)->first();
    }

    return $codigo;
  }
}

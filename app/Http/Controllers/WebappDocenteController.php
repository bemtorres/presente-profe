<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnuncioEspacio;
use App\Models\ClaseEspacio;
use Illuminate\Http\Request;
use App\Models\Espacio;
use App\Services\ImportImage;
use Carbon\Carbon;
use Illuminate\Support\Str;

class WebappDocenteController extends Controller
{
  public function index() {
    $espacios = Espacio::where('id_usuario', current_user()->id)->get();

    return view('webapp_docente.index', compact('espacios'));
  }

  public function espaciosStore(Request $request) {
    try {
      $e = new Espacio();
      $e->id_usuario = current_user()->id;
      $e->nombre = $request->input('nombre');
      $e->sigla = Str::upper($request->input('sigla'));
      $e->periodo = '02-2024';
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
      return redirect()->route('webappdocente.index')->with('success', 'Usuario creado correctamente');
    } catch (\Throwable $th) {
      return back()->with('info','Error. Intente nuevamente.');
    }
  }

  public function espaciosShow($id) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    return view('webapp_docente.espacio.show', compact('e'));
  }

  public function espaciosEdit($id) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    return view('webapp_docente.espacio.edit', compact('e'));
  }

  public function espaciosUpdate(Request $request, $id) {
    try {
      $e = Espacio::where('id_usuario', current_user()->id)->find($id);
      $e->nombre = $request->input('nombre');
      $e->sigla = Str::upper($request->input('sigla'));
      // $e->periodo = '02-2024';
      $e->descripcion = $request->input('descripcion');
      $e->institucion = $request->input('institucion');
      // $e->codigo_unirse = $this->findCodigoUpdate('codigo_unirse');
      // $e->codigo_matricula = $this->findCodigoUpdate('codigo_matricula');

      if(!empty($request->file('image'))){
        $request->validate([
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $filename = time() . '-' . Str::random(3);
        $folder = 'public/assets/espacios/';
        $e->imagen = ImportImage::save($request, 'image', $filename, $folder);
      }

      $e->update();
      return back()->with('success', 'Usuario creado correctamente');
    } catch (\Throwable $th) {
      return back()->with('info','Error. Intente nuevamente.');
    }
  }

  public function anunciosShow($id) {
    $e = Espacio::with('anuncios')->where('id_usuario', current_user()->id)->find($id);
    return view('webapp_docente.espacio.anuncio', compact('e'));
  }

  public function anunciosStore(Request $request, $id) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);

    $anuncio = new AnuncioEspacio();
    $anuncio->titulo = $request->input('titulo');
    $anuncio->mensaje = $request->input('mensaje');
    $anuncio->id_espacio = $e->id;
    $anuncio->estado = 1;
    $anuncio->activo = true;
    $anuncio->save();

    return redirect()->route('webappdocente.espacios.anuncio', $e->id)->with('success', 'Anuncio creado correctamente');
    // return back()->with('success', 'Anuncio creado correctamente');
  }

  public function matriculaIndex($id) {
    $e = Espacio::with('matriculas')->where('id_usuario', current_user()->id)->find($id);
    return view('webapp_docente.espacio.matricula.index', compact('e'));
  }

  public function clasesIndex($id) {
    $e = Espacio::with('clases','clases.asistencias')->where('id_usuario', current_user()->id)->find($id);
    return view('webapp_docente.espacio.clase', compact('e'));
  }

  public function clasesShow($id, $id_c) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    $c = ClaseEspacio::where('id_usuario', current_user()->id)->find($id_c);

    return view('webapp_docente.espacio.clase.index', compact('e', 'c'));
  }

  public function clasesCalendarioShow($id) {
    $e = Espacio::with('clases')->where('id_usuario', current_user()->id)->find($id);
    $fechaHoraActual = Carbon::now()->format('Y-m-d\TH:i');
    $calendario = $this->getCalendario($e);

    return view('webapp_docente.espacio.clase_calendario', compact('e', 'fechaHoraActual', 'calendario'));
  }

  public function clasesStore($id, Request $request) {
    $e = Espacio::where('id_usuario', current_user()->id)->find($id);
    $fechaHora = $request->input('fecha');

    $clase = new ClaseEspacio();
    $clase->fecha = $fechaHora;
    $clase->id_espacio = $e->id;
    $clase->id_usuario = current_user()->id;
    // $clase->info = json_encode($request->input('info'));
    $clase->hora_inicio = $request->input('hora_inicio');
    $clase->hora_termino = $request->input('hora_termino');

    $clase->codigo_web = $this->findCodigoClaseUpdate('codigo_web');
    $clase->activo = true;
    $clase->save();

    return back()->with('success', 'Clase creada correctamente');
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


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dh\Asignatura;
use App\Services\CarreraData;
use App\Services\ImportFile;

class AsignaturaController extends Controller
{
    // Mostrar lista de asignaturas
    public function index()
    {
        $asignaturas = Asignatura::all();
        return view('asignaturas.index', compact('asignaturas'));
    }

    // Mostrar formulario de creación
    public function create()
    {

      $carreras = CarreraData::NOMBRES;
      return view('asignaturas.create', compact('carreras'));
    }

    // Guardar nueva asignatura
    public function store(Request $request)
    {
      $a = new Asignatura();
      $a->nombre = $request->input('nombre');
      $a->sigla = $request->input('sigla');
      $a->semestre = $request->input('semestre');
      $a->programa = $request->input('programa');

      $info = [];
      $info['url'] = $request->input('url');

      if(!empty($request->file('file'))){
        $filename = 'file'. time();
        $folder = 'document_asignatura_web/' . date('Y');
        $name = ImportFile::save($request, 'file', $filename, $folder, false);

        if ($name == 400) {
          return back()->with('error','error archivo no válido');
        }
        $info['file'] = $name;
      }

      $a->info = $info;
      // $a->carrera = $request->input('carrera');
      $a->save();

      return redirect()->route('asignaturas.index')->with('success', 'Asignatura creada exitosamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $a = Asignatura::findOrFail($id);
        return view('asignaturas.edit', compact('a'));
    }

    // Actualizar asignatura
    public function update(Request $request, $id)
    {
      $a = Asignatura::findOrFail($id);
      $a->nombre = $request->input('nombre');
      $a->sigla = $request->input('sigla');
      $a->semestre = $request->input('semestre');
      $a->programa = $request->input('programa');

      $info = $a->info;
      $info['url'] = $request->input('url');

      if(!empty($request->file('file'))){
        $filename = 'file'. time();
        $folder = 'document_asignatura_web/' . date('Y');
        $name = ImportFile::save($request, 'file', $filename, $folder, false);

        if ($name == 400) {
          return back()->with('error','error archivo no válido');
        }
        $info['file'] = $name;
      }
      $a->info = $info;
      $a->update();

      return back()->with('success', 'Asignatura actualizada exitosamente.');
    }

    // Eliminar asignatura
    public function destroy($id)
    {
        $asignatura = Asignatura::findOrFail($id);
        $asignatura->delete();

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura eliminada exitosamente.');
    }

  public function pdf($id) {

    $a = Asignatura::findOrFail($id);
    return view('asignaturas.pdf', compact('a'));
  }

}

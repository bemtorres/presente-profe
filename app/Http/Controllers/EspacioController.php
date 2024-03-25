<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Espacio;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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
      $e->periodo = $request->input('periodo');
      $e->descripcion = $request->input('descripcion');
      $e->institucion = $request->input('institucion');
      $e->codigo_unirse = $this->codigoUpdate('codigo_unirse');
      $e->codigo_registro = $this->codigoUpdate('codigo_registro');
      $e->registro_activo = false;
      $e->save();
      return redirect()->route('admin.espacio.index')->with('success', 'Usuario creado correctamente');
    } catch (\Throwable $th) {
      return $th;
      return back()->with('error', 'Error al crear el usuario');
    }
  }

  // public function show($id) {
  //   $u = Usuario::find($id);
  //   return view('admin.espacio.show', compact('u'));
  // }

  // public function edit($id) {
  //   $u = Usuario::find($id);
  //   return view('admin.espacio.edit', compact('u'));
  // }

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

  // PRIVATE

  private function codigoUpdate($column) {
    $codigo =  "";
    $existe = true;
    while ($existe) {
      $codigo =  Str::random(6);
      $existe = Espacio::where($column, $codigo)->first();
    }

    return $codigo;
  }
}

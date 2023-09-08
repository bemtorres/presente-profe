<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
  public function index() {
    $usuarios = Usuario::get();
    return view('usuario.index', compact('usuarios'));
  }

  public function create() {
    return view('usuario.create');
  }

  public function store(Request $request) {
    $u = new Usuario();
    $u->run = $request->input('run');
    $u->correo = $request->input('correo');
    $u->nombre = $request->input('nombre');
    $u->apellido = $request->input('apellido');
    $u->username = $request->input('correo');
    $u->password = hash('sha256', $request->input('pass'));
    $u->admin = $request->input('admin') == 1 ? true : false;
    $u->id_team = $request->input('team');
    $u->tipo_usuario = $request->input('tipo');
    $u->save();

    return redirect()->route('usuarios.index')->with('success','Se ha creado correctamente');
  }

  public function show($id) {
    $u = Usuario::findOrFail($id);

    return view('usuario.show', compact('u'));
  }

  public function edit($id) {
    $u = Usuario::findOrFail($id);
    return view('usuario.edit', compact('u'));
  }

  public function update(Request $request, $id) {
    $u = Usuario::findOrFail($id);

    if ($request->pass) {
      $u->password = hash('sha256', $request->input('pass'));
      $u->update();
    }

    if ($request->nombre) {
      $u->correo = $request->input('correo');
      $u->run = $request->input('run');
      $u->nombre = $request->input('nombre');
      $u->apellido = $request->input('apellido');
      $u->username = $request->input('correo');
      $u->admin = $request->input('admin') == 1 ? true : false;
      $u->id_team = $request->input('team');
      $u->tipo_usuario = $request->input('tipo');
      $u->update();
    }
    return back()->with('success','Se ha actualizado');
  }

  public function historial($id) {
    $u = Usuario::with(['transacciones'])->findOrFail($id);

    return view('usuario.historial', compact('u'));
  }
}

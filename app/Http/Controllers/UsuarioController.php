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
    $tipos = Usuario::TIPOS;
    return view('usuario.create', compact('tipos'));
  }

  public function store(Request $request) {
    $u = new Usuario();
    $u->correo = $request->input('correo');
    $u->nombre = $request->input('nombre');
    $u->apellido_materno = $request->input('apellido_m');
    $u->apellido_paterno = $request->input('apellido_p');
    $u->password = hash('sha256', $u->correo);
    $u->tipo_usuario = $request->input('admin') == 1 ? 1 : 2;
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
      $u->nombre = $request->input('nombre');
      $u->apellido_paterno = $request->input('apellido_p');
      $u->apellido_materno = $request->input('apellido_m');
      $u->tipo_usuario = $request->input('admin') == 1 ? 1 : 2;
      $u->update();
    }
    return back()->with('success','Se ha actualizado');
  }

  public function historial($id) {
    $u = Usuario::with(['transacciones'])->findOrFail($id);

    return view('usuario.historial', compact('u'));
  }
}

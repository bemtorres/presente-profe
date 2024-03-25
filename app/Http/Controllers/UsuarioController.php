<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{
  public function index() {
    $usuarios = Usuario::where('admin', true)->get();

    return view('admin.usuario.index', compact('usuarios'));
  }

  public function indexPremium() {
    $usuarios = Usuario::where('premium', true)->get();

    return view('admin.usuario.index', compact('usuarios'));
  }

  public function indexNormal() {
    $usuarios = Usuario::where('premium', false)->where('admin', false)->get();

    return view('admin.usuario.index', compact('usuarios'));
  }

  public function create() {
    return view('admin.usuario.create');
  }

  public function store(Request $request) {
    try {
      $u = new Usuario();
      $u->run = $request->input('run');
      $u->nombre = $request->input('nombre');
      $u->apellido_paterno = $request->input('apellido_paterno');
      $u->apellido_materno = $request->input('apellido_materno');
      $u->correo = $request->input('correo');
      $u->password = hash('sha256', $request->pass);
      $u->admin = empty($request->input('check-admin')) ? false : true;
      $u->premium = empty($request->input('check-premium')) ? false : true;
      $u->save();

      return redirect()->route('admin.usuario.index')->with('success', 'Usuario creado correctamente');
    } catch (\Throwable $th) {
      return $th;
      return back()->with('error', 'Error al crear el usuario');
    }
  }

  public function show($id) {
    $u = Usuario::find($id);
    return view('admin.usuario.show', compact('u'));
  }

  public function edit($id) {
    $u = Usuario::find($id);
    return view('admin.usuario.edit', compact('u'));
  }

  public function update(Request $request, $id) {
    $u = Usuario::find($id);
    $u->run = $request->input('run');
    $u->nombre = $request->input('nombre');
    $u->apellido_paterno = $request->input('apellido_paterno');
    $u->apellido_materno = $request->input('apellido_materno');
    $u->correo = $request->input('correo');
    $u->admin = empty($request->input('check-admin')) ? false : true;
    $u->premium = empty($request->input('check-premium')) ? false : true;
    $u->update();
    return back()->with('success', 'Usuario actualizado correctamente');
  }

  public function updatePassword(Request $request, $id) {
    $u = Usuario::find($id);
    $u->password = hash('sha256', $request->pass);
    $u->update();
    return back()->with('success', 'Usuario actualizado correctamente');
  }
}

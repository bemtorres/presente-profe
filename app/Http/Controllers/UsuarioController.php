<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Services\ImportImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
  public function index() {
    $usuarios = Usuario::where('perfil', 1)->get();

    return view('admin.usuario.index', compact('usuarios'));
  }

  public function indexPremium() {
    $usuarios = Usuario::where('perfil', 2)->get();

    return view('admin.usuario.index', compact('usuarios'));
  }

  public function indexNormal() {
    $usuarios = Usuario::where('perfil', 3)->get();

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
      $u->apellido = $request->input('apellido');
      $u->correo = $request->input('correo');
      $u->password = hash('sha256', $request->pass);
      $u->perfil = $request->input('perfil');

      if(!empty($request->file('image'))){
        $request->validate([
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $filename = time() . '-' . Str::random(3);
        $folder = 'public/assets/usuario/';
        $u->imagen = ImportImage::save($request, 'image', $filename, $folder);
      }

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
    $u->apellido = $request->input('apellido');
    $u->correo = $request->input('correo');
    $u->perfil = $request->input('perfil');
    $u->update();
    return back()->with('success', 'Usuario actualizado correctamente');
  }

  public function updatePassword(Request $request, $id) {
    $u = Usuario::find($id);
    $u->password = hash('sha256', $request->pass);
    $u->update();
    return back()->with('success', 'Usuario actualizado correctamente');
  }

  public function updateImg(Request $request, $id) {
    try {
      $u = Usuario::find($id);
      if(!empty($request->file('image'))){
        $request->validate([
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $filename = time() . '-' . Str::random(3);
        $folder = 'public/assets/usuario/';
        $u->imagen = ImportImage::save($request, 'image', $filename, $folder);
      }
      $u->update();
      return back()->with('success', 'Usuario actualizado correctamente');
    } catch (\Throwable $th) {
      return back()->with('error', 'Error al actualizar usuario');
    }
  }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Services\ImportImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PerfilController extends Controller
{
  public function index() {
    $u = current_user();

    return view('admin.perfil.index', compact('u'));
  }

  public function update(Request $request) {
    $u = current_user();
    $u->run = $request->input('run');
    $u->nombre = $request->input('nombre');
    $u->apellido_paterno = $request->input('apellido_paterno');
    $u->apellido_materno = $request->input('apellido_materno');
    $u->correo = $request->input('correo');
    if ($u->admin) {
      // $u->admin = empty($request->input('check-admin')) ? false : true;
      $u->premium = empty($request->input('check-premium')) ? false : true;
    }
    $u->update();
    return back()->with('success', 'Usuario actualizado correctamente');
  }

  public function updatePassword(Request $request) {
    $u = current_user();
    $u->password = hash('sha256', $request->pass);
    $u->update();
    return back()->with('success', 'Usuario actualizado correctamente');
  }

  public function updateImg(Request $request) {
    try {
      $u = current_user();
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

  public function invitar() {
    $u = current_user();

    return view('admin.perfil.invitar', compact('u'));
  }

  public function invitarUpdate(Request $request) {
    $u = current_user();

    $info = $u->info;
    $info['invitar'] = empty($request->input('check-invitar')) ? false : true;
    $u->info = $info;
    $u->update();
    return back()->with('success', 'Código actualizado correctamente');
  }

  public function codigoUpdate() {
    $u = current_user();

    $codigo =  Str::random(8);
    $existe = true;
    while ($existe) {
      $codigo =  Str::random(8);
      $existe = Usuario::where('codigo_invitacion', $codigo)->first();
    }

    $u->codigo_invitacion = $codigo;
    $u->update();

    return back()->with('success', 'Código actualizado correctamente');
  }

}

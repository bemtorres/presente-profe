<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Models\Usuario;
use App\Services\Policies\UsuarioPolicy;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class APIUsuarioController extends Controller
{
  private $policy;

  public function __construct() {
    $this->policy = new UsuarioPolicy();
  }

  public function index() {
    $this->policy->admin(current_user());

    $usuarios = Usuario::get();

    return Response()->json([
      'message' => 'Se ha encontrado correctamente',
      'usuarios' => $usuarios
    ], 200);
  }

  // public function store(Request $request) {
  //   $this->policy->admin(current_user());
  //   $u = new Usuario();
  //   $u->correo = $request->input('correo');
  //   $u->nombre = $request->input('nombre');
  //   $u->apellido_materno = $request->input('apellido_m');
  //   $u->apellido_paterno = $request->input('apellido_p');
  //   $u->password = hash('sha256', $request->input('pass'));
  //   $u->tipo_usuario = $request->input('admin') == 1 ? 1 : 2;
  //   $u->id_sede = $request->input('sede');
  //   $u->save();

  //   return Response()->json([
  //     'message' => 'Se ha creado correctamente',
  //     'data' => $u
  //   ], 200);
  // }

  public function show($id) {
    $this->policy->admin(current_user());

    $u = Usuario::findCorreo(['benja@gmail.co,'])->get();

    return Response()->json([
      'message' => 'Se ha encontrado correctamente',
      'usuario' => $u->to_raw()
    ], 200);
  }

  public function buscar(Request $request) {
    // $this->policy->admin(current_user());

    $busqueda = $request->input('nombre');



    $usuarios = Usuario::where(function($query) use ($busqueda) {
      $query->where('correo', 'like', "%$busqueda%")
            ->orWhere('nombre', 'like', "%$busqueda%");
    })->where('user_app',false)->get();

    // return $usuarios;

    $usuariosEnRaw = $usuarios->map(function($usuario) {
      return $usuario->to_raw();
    });

    return $usuariosEnRaw;

    return Response()->json([
      'message' => 'Se ha encontrado correctamente',
      'usuarios' => $usuariosEnRaw
    ], 200);
  }
}

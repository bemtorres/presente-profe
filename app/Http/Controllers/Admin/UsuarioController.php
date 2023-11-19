<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RevisorSede;
use App\Models\Sede;
use App\Models\Usuario;
use App\Services\Policies\UsuarioPolicy;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
  private $policy;

  public function __construct() {
    $this->policy = new UsuarioPolicy();
  }

  public function index() {
    $this->policy->admin(current_user());

    $usuarios = Usuario::with('sede')->where('tipo_usuario', 2)->get();
    return view('admin.usuario.index', compact('usuarios'));
  }

  public function indexAdmin() {
    $this->policy->admin(current_user());

    $usuarios = Usuario::with('sede')->where('tipo_usuario', 1)->get();
    return view('admin.usuario.index', compact('usuarios'));
  }


  public function indexApp() {
    $this->policy->admin(current_user());

    $usuarios = Usuario::with('sede')->where('user_app', true)->get();
    return view('admin.usuario.index', compact('usuarios'));
  }

  public function create() {
    $this->policy->admin(current_user());

    $tipos = Usuario::TIPOS;
    $sedes = Sede::all();
    return view('admin.usuario.create', compact('tipos','sedes'));
  }

  public function store(Request $request) {
    $this->policy->admin(current_user());
    $u = new Usuario();
    $u->correo = $request->input('correo');
    $u->nombre = $request->input('nombre');
    $u->apellido_materno = $request->input('apellido_m');
    $u->apellido_paterno = $request->input('apellido_p');
    $u->password = hash('sha256', $request->input('pass'));
    $u->user_app = $request->input('user_app') == 'si' ? true : false;
    $u->tipo_usuario = $request->input('admin') == 1 ? 1 : 2;
    $u->id_sede = $request->input('sede');
    $u->save();
    return redirect()->route('usuarios.index')->with('success','Se ha creado correctamente');
  }

  public function show($id) {
    $this->policy->admin(current_user());

    $u = Usuario::findOrFail($id);

    return view('admin.usuario.show', compact('u'));
  }

  public function edit($id) {
    $this->policy->admin(current_user());

    $u = Usuario::findOrFail($id);
    $sedes = Sede::all();
    return view('admin.usuario.edit', compact('u', 'sedes'));
  }

  public function update(Request $request, $id) {
    $this->policy->admin(current_user());

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
      $u->id_sede = $request->input('sede') == 1300 ? 1300 : 100;
      $u->user_app = $request->input('user_app') == 'si' ? true : false;
      $u->update();
    }
    return back()->with('success','Se ha actualizado');
  }

  public function sedes($id) {
    $sedes = Sede::orderBy('activo', 'desc')->orderBy('nombre', 'asc')->get();
    $u = Usuario::with('revisorSede')->findOrFail($id);

    foreach ($sedes as $key => $s) {
      $s->checked = false;

      foreach ($u->revisorSede as $keyR => $r) {
        if ($s->id == $r->id_sede && $r->activo) {
          $s->checked = true;
          break;
        }
      }
    }

    return view('admin.usuario.sedes', compact('u','sedes'));
  }

  public function sedesUpdate(Request $request, $id) {
    $sede_id = $request->input('sede_id');
    $u = Usuario::findOrFail($id);
    $rs = RevisorSede::where('id_usuario', $u->id)->where('id_sede', $sede_id)->first();

    if ($rs == null) {
      $rs = new RevisorSede();
      $rs->id_usuario = $u->id;
      $rs->id_sede = $sede_id;
      $rs->activo = true;
      $rs->save();
    } else {
      $rs->activo = !$rs->activo;
      $rs->update();
    }

    // return $rs;
    return back()->with('success','Se ha actualizado');
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Services\DuocHorario;
use Illuminate\Http\Request;

class SedeController extends Controller
{
  public function index() {
    $sedes = Sede::with(['salas'])->get();
    return view('admin.sede.index', compact('sedes'));
  }

  public function show($id) {
    $s = Sede::with(['salas'])->findOrFail($id);
    return view('admin.sede.show', compact('s'));
  }

  public function salas($id) {
    $s = Sede::with(['salas'])->findOrFail($id);
    $salas = $s->salas;

    $my_horario = [];
    $horarios = DuocHorario::TIMES;

    return view('admin.sede.sala.index', compact('s', 'salas', 'my_horario', 'horarios'));
  }


  // public function edit($id) {
  //   $this->policy->admin(current_user());

  //   $u = Usuario::findOrFail($id);
  //   return view('admin.usuario.edit', compact('u'));
  // }

  // public function update(Request $request, $id) {
  //   $this->policy->admin(current_user());

  //   $u = Usuario::findOrFail($id);

  //   if ($request->pass) {
  //     $u->password = hash('sha256', $request->input('pass'));
  //     $u->update();
  //   }

  //   if ($request->nombre) {
  //     $u->correo = $request->input('correo');
  //     $u->nombre = $request->input('nombre');
  //     $u->apellido_paterno = $request->input('apellido_p');
  //     $u->apellido_materno = $request->input('apellido_m');
  //     $u->tipo_usuario = $request->input('admin') == 1 ? 1 : 2;
  //     $u->id_sede = $request->input('sede') == 1300 ? 1300 : 100;
  //     $u->update();
  //   }
  //   return back()->with('success','Se ha actualizado');
  // }

  // public function sedes($id) {
  //   $sedes = Sede::all();
  //   $u = Usuario::with('revisorSede')->findOrFail($id);

  //   foreach ($sedes as $key => $s) {
  //     $s->checked = false;

  //     foreach ($u->revisorSede as $keyR => $r) {
  //       if ($s->id == $r->id_sede && $r->activo) {
  //         $s->checked = true;
  //         break;
  //       }
  //     }
  //   }

  //   return view('admin.usuario.sedes', compact('u','sedes'));
  // }

  // public function sedesUpdate(Request $request, $id) {
  //   $sede_id = $request->input('sede_id');
  //   $u = Usuario::findOrFail($id);
  //   $rs = RevisorSede::where('id_usuario', $u->id)->where('id_sede', $sede_id)->first();

  //   if ($rs == null) {
  //     $rs = new RevisorSede();
  //     $rs->id_usuario = $u->id;
  //     $rs->id_sede = $sede_id;
  //     $rs->activo = true;
  //     $rs->save();
  //   } else {
  //     $rs->activo = !$rs->activo;
  //     $rs->update();
  //   }

  //   // return $rs;
  //   return back()->with('success','Se ha actualizado');
  // }
}

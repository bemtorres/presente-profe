<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Models\Semestre;
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

  public function email($id) {
    $s = Sede::findOrFail($id);


    return view('admin.sede.email.index', compact('s'));
  }


  public function emailStore(Request $request, $id) {
    $s = Sede::findOrFail($id);
    $correo = $request->input('correo');

    $info = $s->getInfoCorreo();

    $correos_new = [
      'status' => true,
      'correo' => $correo,
    ];

    $encontrado = false;
    foreach ($info as $key => $correo_copia) {
      if ($correo_copia['correo'] == $correo) {
        $encontrado = true;
        break;
      }
    }

    if ($encontrado) {
      return back()->with('danger','El correo ya existe');
    }

    array_push($info, $correos_new);

    $array_info = $s->info;
    $array_info['correos_copia'] = $info;
    $s->info = $array_info;
    $s->update();

    return back()->with('success','Se ha añadido el correo');
  }

  public function emailUpdate(Request $request, $id) {
    $s = Sede::findOrFail($id);
    $correo = $request->input('correo');

    $info = $s->getInfoCorreo();
    $encontrado = false;

      foreach ($info as $key => $correo_copia) {
      if ($correo_copia['correo'] == $correo) {
        $encontrado = true;
        $info[$key]['status'] = !$info[$key]['status'];
        // $correo_copia['status'] = true;

        $array_info = $s->info;
        $array_info['correos_copia'] = $info;
        $s->info = $array_info;
        $s->update();
        break;
      }
    }

    if ($encontrado) {
      return back()->with('success','Se ha actualizdo el correo');
    }

    return back()->with('danger','El correo ya existe');
  }

  public function emailDelete(Request $request, $id) {
    $s = Sede::findOrFail($id);
    $correo = $request->input('correo');

    $info = $s->getInfoCorreo();

    foreach ($info as $key => $correo_copia) {
      if ($correo_copia['correo'] == $correo) {
        unset($info[$key]);
        $array_info = $s->info;
        $array_info['correos_copia'] = $info;
        $s->info = $array_info;
        $s->update();
        return back()->with('success','Se ha actualizdo el correo');
      }
    }

    return back()->with('danger','El correo ya existe');
  }

  public function salas($id) {
    $s = Sede::with(['salas'])->findOrFail($id);
    $salas = $s->salas;

    $horarios = DuocHorario::TIMES;
    $semestre = Semestre::where('activo', true)->with('semanas')->first();

    $array_semestre = [];

    foreach ($semestre->semanas as $keyS => $valueS) {
      $array_semestre[] = [
        'periodo' => $semestre->periodo,
        'semestre' => $semestre->semestre,
        'info' => $valueS->getInfo(),
        'semana' => $valueS->semana,
        'fecha_inicio' => $valueS->fecha_inicio,
        'fecha_termino' => $valueS->fecha_termino,
      ];
    }

    return view('admin.sede.sala.index', compact('s', 'array_semestre', 'semestre', 'salas', 'horarios'));
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

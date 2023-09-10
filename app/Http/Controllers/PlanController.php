<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\dh\Plan;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PlanController extends Controller
{
  public function index() {
    $planes = Plan::where('id_usuario', current_user()->id)->get();

    return view('planes.index', compact('planes'));
  }

  public function create() {
    return view('planes.create');
  }

  public function store(Request $request) {

    $p = new Plan();
    $p->nombre = $request->input('nombre');
    $p->descripcion = $request->input('descripcion');
    $p->id_usuario = current_user()->id;
    // $p->estado = $request->input('estado');
    $p->estado = 0;
    // $p->codigo =
    $p->save();

    return redirect()->route('planes.index')->with('success','Se ha creado correctamente');
  }

  public function show($id) {
    $plan = Plan::where('id_usuario', current_user()->id)->findOrFail($id);

    return view('planes.show', compact('plan'));
  }

  public function inscritos($id) {
    $plan = Plan::where('id_usuario', current_user()->id)->findOrFail($id);

    return view('planes.id.inscritos', compact('plan'));
  }

  public function inscribir($id) {
    $plan = Plan::where('id_usuario', current_user()->id)->findOrFail($id);


    $usuarios = Usuario::get();


    return view('planes.id.inscribir', compact('usuarios','plan'));
  }


  public function compartir($id) {
    $plan = Plan::where('id_usuario', current_user()->id)->findOrFail($id);

    return view('planes.id.compartir', compact('plan'));
  }
}

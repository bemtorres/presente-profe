<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
  public function index() {
    $id_sede = current_user()->sede->id;
    $semestre = Semestre::where('activo', true)->firstOrFail();

    $solicitudes = Solicitud::where('id_sede', $id_sede )
                            ->where('estado', 1)
                            ->get();
    return view('admin.solicitud.index', compact('solicitudes','semestre'));
  }

  public function indexRealizados() {
    $id_sede = current_user()->sede->id;
    $semestre = Semestre::where('activo', true)->firstOrFail();

    $solicitudes = Solicitud::where('id_sede', $id_sede )
                            ->where('estado', 2)
                            ->get();
    return view('admin.solicitud.index', compact('solicitudes','semestre'));
  }

  public function indexCancelados() {
    $id_sede = current_user()->sede->id;
    $semestre = Semestre::where('activo', true)->firstOrFail();

    $solicitudes = Solicitud::where('id_sede', $id_sede )
                            ->where('estado', 3)
                            ->get();
    return view('admin.solicitud.index', compact('solicitudes','semestre'));
  }

  public function meindex() {
    $id_sede = current_user()->id_sede;
    $semestre = Semestre::where('activo', true)->firstOrFail();

    $solicitudes = Solicitud::where('id_sede', $id_sede )
                            ->where('id_usuario', current_user()->id)
                            ->get();

    return view('admin.solicitud.meindex', compact('solicitudes','semestre'));
  }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $s = Solicitud::findOrFail($id);
      return $s;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

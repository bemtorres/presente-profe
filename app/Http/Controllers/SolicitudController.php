<?php

namespace App\Http\Controllers;

use App\Models\Semana;
use App\Models\Semestre;
use App\Models\Solicitud;
use App\Services\DuocHorario;
use App\Services\EmailServices;
use App\Services\Policies\UsuarioPolicy;
use App\Services\RegistroDias;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
  private $policy;

  public function __construct() {
    $this->policy = new UsuarioPolicy();
  }

  public function index() {
    $this->policy->admin(current_user());

    $id_sede = current_user()->sede->id;
    $semestre = Semestre::where('activo', true)->firstOrFail();

    $solicitudes = Solicitud::where('id_sede', $id_sede )
                            ->where('estado', 1)
                            ->get();
    return view('admin.solicitud.index', compact('solicitudes','semestre'));
  }

  public function indexAceptadas() {
    $this->policy->admin(current_user());

    $id_sede = current_user()->sede->id;
    $semestre = Semestre::where('activo', true)->firstOrFail();

    $solicitudes = Solicitud::where('id_sede', $id_sede )
                            ->where('estado', 2)
                            ->get();
    return view('admin.solicitud.index', compact('solicitudes','semestre'));
  }

  public function indexCancelados() {
    $this->policy->admin(current_user());

    $id_sede = current_user()->sede->id;
    $semestre = Semestre::where('activo', true)->firstOrFail();

    $solicitudes = Solicitud::where('id_sede', $id_sede )
                            ->where('estado',4)
                            ->get();
    return view('admin.solicitud.index', compact('solicitudes','semestre'));
  }

  public function indexRechazadas() {
    $this->policy->admin(current_user());

    $id_sede = current_user()->sede->id;
    $semestre = Semestre::where('activo', true)->firstOrFail();

    $solicitudes = Solicitud::where('id_sede', $id_sede )
                            ->where('estado',3)
                            ->get();
    return view('admin.solicitud.index', compact('solicitudes','semestre'));
  }

  public function meindex() {
    $id_sede = current_user()->id_sede;
    $semestre = Semestre::where('activo', true)->firstOrFail();

    $solicitudes = Solicitud::where('id_sede', $id_sede )
                            ->where('id_usuario', current_user()->id)
                            ->get();

    return view('admin.solicitud.me.index', compact('solicitudes','semestre'));
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
      // $s = Solicitud::findOrFail($id);
      $this->policy->admin(current_user());

      $s = Solicitud::with(['registros','usuario'])->findOrFail($id);
      // $semestre = Semestre::where('activo', true)->firstOrFail();
      $semestre = Semestre::where('activo', true)->with('semanas')->first();

      $semana = Semana::where('id_semestre', $semestre->id)->where('semana', $s->semana)->first();
      $dias =  $semana->getWeeks();

      $horarios = DuocHorario::TIMES;

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

      $data_registros = (new RegistroDias($s->registros))->call();
      return view('admin.solicitud.show', compact('s', 'data_registros','semestre','array_semestre','horarios', 'dias'));
    }

    public function meshow($id)
    {
      $s = Solicitud::where('id_usuario', current_user()->id)->with(['registros','usuario'])->findOrFail($id);
      $semestre = Semestre::where('activo', true)->firstOrFail();
      $semana = Semana::where('id_semestre', $semestre->id)->where('semana', $s->semana)->first();
      $dias =  $semana->getWeeks();

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

      $data_registros = (new RegistroDias($s->registros))->call();

      return view('admin.solicitud.me.show', compact('s', 'data_registros','semestre','array_semestre','horarios', 'dias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
      $this->policy->admin(current_user());

      $s = Solicitud::with(['registros'])->findOrFail($id);
      $s->id_revisor = current_user()->id;
      $estado = 2;

      $s->estado = $estado;
      $s->update();

      foreach ($s->registros as $key => $r) {
        $r->estado = $estado;
        $r->update();
      }

      $email = new EmailServices($s->usuario->correo, [], $s->id);
      $email->solicitudAprobada();

      return back()->with('success','Se ha actualizado correctamente la solicitud');
    }

    public function updateRechazar(Request $request, $id) {
      $this->policy->admin(current_user());

      $s = Solicitud::with(['registros'])->findOrFail($id);
      $s->id_revisor = current_user()->id;
      $estado = 3;

      $s->estado = $estado;
      $s->update();

      foreach ($s->registros as $key => $r) {
        $r->estado = $estado;
        $r->update();
      }

      $email = (new EmailServices($s->usuario->correo, [], $s->id))->solicitudRechazada();
      return back()->with('success','Se ha actualizado correctamente la solicitud');
    }

    public function updateCancelar(Request $request, $id)
    {
      $s = Solicitud::where('id_usuario', current_user()->id)->with('registros')->findOrFail($id);
      $s->estado = 4;
      $s->update();

      foreach ($s->registros as $key => $r) {
        $r->estado = 4;
        $r->update();
      }

      $mail = (new EmailServices(current_user()->correo, [], $s->id))->solicitudCancelado();
      return back()->with('success','Se ha cancelado correctamente la solicitud');
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

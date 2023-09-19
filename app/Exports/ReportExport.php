<?php

namespace App\Exports;

// use App\Models\TomaHora\Especialidad;

use App\Models\dh\HorarioPlan;
use App\Models\dh\Plan;
use Rap2hpoutre\FastExcel\FastExcel;

class ReportExport {
  private $id;
  private $name;

  private $export;

  public function __construct(int $id, string $name = '', string $format = 'xlsx'){
    $this->id = $id;
    $this->name = $name;
    $this->setExport($format);
  }

  private function setExport(string $format){
    $this->export = time() . '0000' .$this->name.'.'.$format;
  }

  public function download(){

    // return (new FastExcel(HorarioPlan::get()))->download('file.xlsx');

    try {
      $horarios = HorarioPlan::where('id_plan', $this->id)->with('usuario')->get();

      $list = collect([
          [ 'id' => 1, 'name' => 'Jane' ],
          [ 'id' => 2, 'name' => 'John' ],
      ]);

      return (new FastExcel($list))->download('file.xlsx');
      // return (new FastExcel(HorarioPlan::get()))->download('file.xlsx');
      // return (new FastExcel($list))->download('file.xlsx');

      // return (new FastExcel($horarios))->download($this->export, function ($h) {
      //   return [
      //     'DIA'  => 'aaa',
      //     'ENTRADA' => $h->getHorarioEntrada(),
      //     'SALIDA' => $h->getHorarioSalida(),
      //     'DOCENTE' => $h->usuario->nombre_completo(),
      //     'CORREO' => $h->usuario->correo,
      //   ];
      // });
    } catch (\Throwable $th) {
      return $th;
    }
  }
}


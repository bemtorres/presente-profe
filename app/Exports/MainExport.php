<?php
namespace App\Exports;

use App\Models\dh\HorarioPlan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class MainExport implements FromView
{
  use Exportable;

  public function view(): View
  {
    $horarios = HorarioPlan::all();

    return view('exports.main', [
        'horarios' => $horarios,
    ]);
  }
}

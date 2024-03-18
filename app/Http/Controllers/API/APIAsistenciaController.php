<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\GlobalAsignatura;
use Illuminate\Http\Request;

class APIAsistenciaController extends Controller
{
  public function show(Request $request, $siglas) {


    // $a = GlobalAsignatura::where('siglas', $siglas)->with('semanas')->first();
    // $a = GlobalAsignatura::where('siglas', $siglas)->first();

    $today = date('Y-m-d');
    $asistieron = [
      '19055338-8' => true,
      '19055338-9' => false,
    ];

    return response()->json($asistieron);
  }
}

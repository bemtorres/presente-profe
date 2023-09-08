<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Sistema;
use App\Models\Usuario;
use App\Services\DuocHorario;
use Auth;
use Illuminate\Http\Request;


// use App\Http\Requests\AuthLoginRequest as AuthRequest;

class HomeController extends Controller
{
  public function index() {

    $horarios = DuocHorario::TIMES;

    // return $horario;

    return view('home.index', compact('horarios'));
  }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\GlobalAsignatura;
use Illuminate\Http\Request;


class APIUsuarioController extends Controller
{

/**
 * @OA\PathItem(
 *   path="/usuarios",
 *   @OA\Get(
 *     tags={"Usuarios"},
 *     summary="Obtener lista de usuarios",
 *     description="Devuelve una lista de usuarios",
 *     @OA\Response(
 *       response=200,
 *       description="Operación exitosa"
 *     )
 *   )
 * )
 */


  public function auth(Request $request) {

    $u = $request->user();



    // $a = GlobalAsignatura::where('siglas', $siglas)->with('semanas')->first();
    // $a = GlobalAsignatura::where('siglas', $siglas)->first();

    // $today = date('Y-m-d');
    // $asistieron = [
    //   '19055338-8' => true,
    //   '19055338-9' => false,
    // ];
    // crea un has unico
    $token = uniqid();

    $u->token = $token;
    $u->update();
    return response()->json($token);
  }
}

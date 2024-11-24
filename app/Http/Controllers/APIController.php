<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller as BaseController;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @OA\Info(
 *     title="Presente profe API 2024",
 *     version="0.1",
 *      @OA\Contact(
 *          name="Benjamin Mora",
 *          email="bej.mora@profesor.duoc.cl"
 *      ),
 * ),
*   @OA\Tag(
*        name="Auth:Autenticación",
*        description="Endpoints relacionados inicio de sesión y registro de usuarios"
*     ),
*   @OA\Tag(
*        name="Auth:Usuarios",
*        description="Endpoints relacionados con la gestión de usuarios"
*     ),
 *  @OA\Server(
 *      description="Production",
 *      url="https://www.presenteprofe.test/"
 *  ),
 *  *  @OA\Server(
 *      description="Ambiente de desarrollo",
 *      url="https://presenteprofe.test/"
 *  ),
 *
 */
class APIController extends BaseController {

  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  protected $user_token;
  protected $user_get;
  protected $user_auth;

  public function __construct(Request $request) {
    // METODO 1
    $authHeader = $request->header('Authorization');

    if ($authHeader) {
      list($bearer, $token) = explode(' ', $authHeader);
      if ($bearer === 'Bearer' && $token) {
        $personalAccessToken = PersonalAccessToken::findToken($token);
        if ($personalAccessToken) {
          $this->user_token = $personalAccessToken->tokenable;
          $this->user_auth = $this->user_token;
        }
      }
    }

    // METODO 2
    $correo = $request->query('user');
    if ($correo) {
      $this->user_get = Usuario::findByCorreo($correo)->first();
      $this->user_auth = $this->user_get;
    }
  }
}

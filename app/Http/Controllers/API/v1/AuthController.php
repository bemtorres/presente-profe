<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\APIController;
use App\Mail\ResetPasswordEmail;
use App\Models\Usuario;
use App\Models\UsuarioInvitado;
use App\Services\EmailUser;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends APIController {
/**
 * @OA\Post(
 *     path="/api/v1/auth",
 *     summary="Iniciar sesión y generar token de autenticación",
 *     tags={"Auth:Autenticación"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"correo", "password"},
 *             @OA\Property(property="correo", type="string", format="email", example="example@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="mypassword123"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Inicio de sesión exitoso",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Success"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="correo", type="string", example="example@example.com")
 *             ),
 *             @OA\Property(property="auth", type="object",
 *                 @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."),
 *                 @OA\Property(property="type", type="string", example="Bearer")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Error en las credenciales",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Error"),
 *             @OA\Property(property="data", type="null")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Error"),
 *             @OA\Property(property="data", type="null"),
 *             @OA\Property(property="error", type="string", example="Detalles del error")
 *         )
 *     ),
 * )
 */
  public function login(Request $request) {
    try {
      $u = Usuario::findByCorreo($request->correo)->firstOrFail();
      $pass =  hash('sha256', $request->password);
      if ($u->password == $pass) {
        Auth::guard('usuario')->loginUsingId($u->id, true);
        $user =  auth('usuario')->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
          'message' => 'Success',
          'perfil' => $u->getPefil(),
          'auth' => [
            'token' => $token,
            'type' => 'Bearer'
          ],
          'data' => $u->to_raw()
        ], 200);
      } else {
        return response()->json([
          'message' => 'Error',
          'data' => null
        ], 404);
      }
    } catch (\Throwable $th) {
      return response()->json([
        'message' => 'Error',
        'data' => null,
        'eroor' => $th->getMessage()
      ],500);
    }
  }

  /**
   * @OA\Get(
   *     path="/api/v1/auth/me",
   *     summary="Obtener mi informacion de usuario",
   *     tags={"Auth:Usuarios"},
   *     security={{ "bearerAuth": {} }},
   *     @OA\Parameter(
   *         name="user",
   *         in="query",
   *         description="Correo electrónico del usuario",
   *         required=false,
   *         @OA\Schema(
   *             type="string",
   *             format="email",
   *             example="correo@gmail.com"
   *         )
   *     ),
   *    @OA\Response(
   *         response=200,
   *         description="Informacion de usuario obtenida correctamente",
   *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Success"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="run", type="string", example="12345678-9"),
 *                 @OA\Property(property="nombre", type="string", example="Juan"),
 *                 @OA\Property(property="apellido", type="string", example="Pérez"),
 *                 @OA\Property(property="nombre_completo", type="string", example="Juan Pérez"),
 *                 @OA\Property(property="correo", type="string", example="juan.perez@example.com"),
 *                 @OA\Property(property="perfil", type="string", example="estudiante"),
 *                 @OA\Property(property="img", type="string", example="http://example.com/path/to/image.jpg")
 *             )
 *         )
   *     ),
   *     @OA\Response(
   *         response=401,
   *         description="No autenticado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="No autenticado"),
   *         )
   *     )
   * )
   */
  public function me() {
    if (!$this->user_auth) {
      return response()->json(['message' => 'No autenticado'], 401);
    } else {
      if ($this->user_token) {
        return response()->json(['message' => 'Success','data' => $this->user_token->to_raw()], 200);
      }
      if ($this->user_get) {
        return response()->json(['message' => 'Success','data' => $this->user_get->to_raw()], 200);
      }
      return response()->json(['message' => 'No autenticado'], 401);
    }
  }

/**
 * @OA\Post(
 *     path="/api/v1/usuarios",
 *     summary="Registrar un nuevo usuario mediante código de invitación",
 *     tags={"Auth:Autenticación"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="codigo", type="string", example="presenteprofe"),
 *             @OA\Property(property="run", type="string", example="12345678-9"),
 *             @OA\Property(property="nombre", type="string", example="Juan"),
 *             @OA\Property(property="apellido", type="string", example="Pérez"),
 *             @OA\Property(property="correo", type="string", format="email", example="correo@gmail.com"),
 *             @OA\Property(property="perfil", type="string", enum={"docente", "estudiante"}, example="docente|estudiante"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Usuario registrado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Usuario registrado exitosamente")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Error de validación, falta el perfil")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Código de invitación no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Código de invitación no válido")
 *         )
 *     )
 * )
 */
  public function store(Request $request) {
    $codigo_invitacion = Str::lower($request->input('codigo'));

    if ($codigo_invitacion == "presenteprofe") {
      $usuario_main = Usuario::first();
    } else {
      $usuario_main = Usuario::findCodeInvitacion($codigo_invitacion)->firstOrFail();
    }

    $exist = Usuario::findByCorreo($request->correo)->first();

    if ($usuario_main->getInfoInvitar() || $codigo_invitacion == "presenteprofe") {
      if (empty($exist)) {
        // $codigo = Str::random(8);
        $password_new = 123456; // :FIX:ERROR_EMAIL

        $u = new Usuario();
        $u->run = $request->input('run');
        $u->nombre = $request->input('nombre');
        $u->apellido = $request->input('apellido');
        $u->correo = $request->input('correo');
        $u->password = hash('sha256', $password_new);

        $perfil = $request->input('perfil');

        if ($perfil == 'docente' || $perfil == 'estudiante') {
          if ($perfil == 'estudiante') {
            $u->perfil = 3;
          } else {
            $u->perfil = 2;
          }
        } else {
          return response()->json([
            'message' => 'Error de validación, falta el perfil',
          ], 400);
        }

        $u->save();

        $info = $usuario_main->info;
        $info['invitar_count'] = $usuario_main->getInfoInvitarCount() + 1;
        $usuario_main->info = $info;
        $usuario_main->update();

        $uinvitado = new UsuarioInvitado();
        $uinvitado->id_usuario = $usuario_main->id;
        $uinvitado->id_invitado = $u->id;
        $uinvitado->save();

        (new EmailUser($u, $password_new))->registro();

        return response()->json([
          'message' => 'Success',
          'data' => $u->to_raw()
        ], 201);
      } else {
        return response()->json(['message' => 'El correo ya está registrado.'], 400);
      }
    }
    return response()->json(['message' => 'Código de invitación no válido'], 404);
  }

  /**
   * @OA\Post(
   *     path="/api/v1/auth/recuperar",
   *     summary="Recuperar la contraseña del usuario",
   *     tags={"Auth:Autenticación"},
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             required={"correo"},
   *             @OA\Property(property="correo", type="string", format="email", example="correo@gmail.com")
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Solicitud de recuperación de contraseña enviada correctamente",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Solicitud de recuperación de contraseña enviada correctamente")
   *         )
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="Usuario no encontrado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Usuario no encontrado")
   *         )
   *     ),
   *     @OA\Response(
   *         response=500,
   *         description="Ocurrió un error durante la recuperación",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Ocurrió un error durante la recuperación"),
   *             @OA\Property(property="error", type="string", example="Descripción del error")
   *         )
   *     )
   * )
   */
  public function recuperar(Request $request) {
    // Validar que el correo es un email válido
    $request->validate([
        'correo' => 'required|email'
    ]);

    try {
      // Buscar usuario por correo
      $u = Usuario::findByCorreo($request->correo)->first();

      if (!$u) {
        return response()->json([
          'message' => 'Usuario no encontrado',
        ], 404);
      }

      // Generar un token de recuperación o una nueva contraseña temporal
      $password_new = 123456; // :FIX:ERROR_EMAIL

      // Actualizar contraseña
      $u->password = hash('sha256', $password_new);
      $u->save();

      // Enviar correo de recuperación de contraseña
      (new EmailUser($u, $password_new))->password_reset();

      return response()->json([
          'message' => 'Solicitud de recuperación de contraseña enviada correctamente',
      ], 200);
    } catch (\Throwable $th) {
      // Devolver respuesta de error con detalles
      return response()->json([
        'message' => 'Ocurrió un error durante la recuperación',
        'error' => $th->getMessage()
      ], 500);
    }
  }

/**
 * @OA\Put(
 *     path="/api/v1/usuarios/password",
 *     summary="Actualizar la contraseña del usuario autenticado",
 *     tags={"Auth:Usuarios"},
 *     security={{"BearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"password"},
 *             @OA\Property(property="password", type="string", format="password", example="NuevaContraseña123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contraseña actualizada exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Contraseña actualizada correctamente")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autenticado. El usuario no está autenticado.",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No autenticado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Contraseña no proporcionada o inválida.",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="La contraseña no es válida")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Ocurrió un error al actualizar la contraseña",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Error interno al procesar la solicitud"),
 *             @OA\Property(property="error", type="string", example="Descripción del error")
 *         )
 *     )
 * )
 */
public function updatePassword(Request $request)
{
    // Asegurarse de que el usuario está autenticado
    if (!$this->user_auth) {
        return response()->json([
            'message' => 'No autenticado',
        ], 401);
    }

    // Obtener el usuario autenticado
    $user = $this->user_auth;
    $password = $request->input('password');

    // Verificar que la nueva contraseña es válida
    if (empty($password)) {
        return response()->json([
            'message' => 'La contraseña no es válida',
        ], 400);
    }

    // Actualizar la contraseña del usuario
    $user->password = hash('sha256', $password);
    $user->update();

    return response()->json(['message' => 'Contraseña actualizada correctamente'], 200);
  }
}

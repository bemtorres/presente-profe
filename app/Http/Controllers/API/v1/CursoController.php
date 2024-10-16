<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\APIController;
use App\Models\AsistenciaEspacio;
use App\Models\ClaseEspacio;
use App\Models\Espacio;
use App\Models\MatriculaEspacio;
use Illuminate\Http\Request;
use Str;

class CursoController extends APIController
{
  /**
   * @OA\Get(
   *     path="/api/v1/cursos",
   *     summary="Obtener cursos del usuario autenticado o por correo",
   *     tags={"Cursos"},
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
   *     @OA\Response(
   *         response=200,
   *         description="Lista de cursos obtenida correctamente",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Success"),
   *             @OA\Property(property="cursos", type="array", @OA\Items(
   *                 @OA\Property(property="id", type="integer", example=1),
   *                 @OA\Property(property="nombre", type="string", example="Curso de Laravel"),
   *                 @OA\Property(property="descripcion", type="string", example="Introducción a Laravel"),
   *             ))
   *         )
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="No autenticado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Error"),
   *         )
   *     )
   * )
   */
  public function index(Request $request) {
    if (!$this->user_auth) {
      return response()->json([
        'message' => 'No autenticado',
      ], 401);
    }
    // Obtener los cursos relacionados con el usuario
    $cursos = Espacio::where('id_usuario', $this->user_auth->id)->get();

    $toRawrValues = $cursos->map(function ($curso) {
      return $curso->to_raw();
    });

    return response()->json([
        'message' => 'Success',
        'cursos' => $toRawrValues
    ], 200);
  }


    /**
   * @OA\Post(
   *     path="/api/v1/cursos",
   *     summary="Crear un nuevo curso",
   *     tags={"Cursos"},
   *     security={{ "bearerAuth": {} }},
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             required={"nombre", "sigla", "institucion"},
   *             @OA\Property(property="nombre", type="string", example="Curso de Laravel"),
   *             @OA\Property(property="sigla", type="string", example="LAR101"),
   *             @OA\Property(property="institucion", type="string", example="Duoc UC"),
   *             @OA\Property(property="descripcion", type="string", example="Introducción a Laravel"),
   *         )
   *     ),
   *     @OA\Response(
   *         response=201,
   *         description="Curso creado exitosamente",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Curso creado exitosamente"),
   *             @OA\Property(property="data", type="object",
   *                 @OA\Property(property="id", type="integer", example=1),
   *                 @OA\Property(property="nombre", type="string", example="Curso de Laravel"),
   *                 @OA\Property(property="sigla", type="string", example="LAR101"),
   *                 @OA\Property(property="institucion", type="string", example="Duoc UC"),
   *                 @OA\Property(property="descripcion", type="string", example="Introducción a Laravel")
   *             )
   *         )
   *     ),
   *     @OA\Response(
   *         response=400,
   *         description="Error de validación",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Error de validación"),
   *         )
   *     )
   * )
   */
  public function store(Request $request) {
    if (!$this->user_auth) {
      return response()->json([
        'message' => 'No autenticado',
      ], 401);
    }

    // Validar los datos
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'sigla' => 'required|string|max:50',
        'institucion' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
    ]);

    // Crear el curso
    // $curso = Curso::create($validatedData);
    $curso = new Espacio();
    $curso->nombre = $request->input('nombre');
    $curso->sigla = $request->input('sigla');
    $curso->institucion = $request->input('institucion');
    $curso->descripcion = $request->input('descripcion');
    $curso->id_usuario = $this->user_auth->id;
    $curso->codigo_unirse = $this->findCodigoUpdate('codigo_unirse',10);
    $curso->codigo_matricula = $this->findCodigoUpdate('codigo_matricula',10);

    $curso->periodo = date('Y');
    $curso->save();

    // Retornar respuesta exitosa
    return response()->json([
        'message' => 'Curso creado exitosamente',
        'data' => $curso
    ], 201);
  }

  /**
   * @OA\Get(
   *     path="/api/v1/cursos/{id}",
   *     summary="Obtener información del curso por ID o por correo del usuario",
   *     tags={"Cursos"},
   *     security={{ "bearerAuth": {} }},
   *     @OA\Parameter(
   *         name="id",
   *         in="path",
   *         required=true,
   *         description="ID del curso",
   *         @OA\Schema(type="integer")
   *     ),
   *     @OA\Parameter(
   *         name="user",
   *         in="query",
   *         description="Correo electrónico del usuario",
   *         required=true,
   *         @OA\Schema(
   *             type="string",
   *             format="email",
   *             example="correo@gmail.com"
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Curso obtenido correctamente",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Curso obtenido correctamente"),
   *             @OA\Property(property="curso", type="object",
   *                 @OA\Property(property="id", type="integer", example=1),
   *                 @OA\Property(property="nombre", type="string", example="Curso de Laravel"),
   *                 @OA\Property(property="descripcion", type="string", example="Introducción a Laravel"),
   *                 @OA\Property(property="user", type="string", example="correo@gmail.com")
   *             )
   *         )
   *     ),
   *     @OA\Response(
   *         response=403,
   *         description="Usuario no encontrado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Error"),
   *         )
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="Curso no encontrado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Curso no encontrado"),
   *         )
   *     )
   * )
   */
  public function show($id,Request $request) {
    if (!$this->user_auth) {
      return response()->json([
        'message' => 'No autenticado',
      ], 401);
    }
    // Obtener los cursos relacionados con el usuario
    $curso = Espacio::where('id_usuario', $this->user_auth->id)->find($id);
    if (!$curso) {
      return response()->json(['message' => 'Curso no encontrado',], 404);
    }
    return response()->json(['message' => 'Success','curso' => $curso->to_raw()], 200);
  }


/**
 * @OA\Get(
 *     path="/api/v1/cursos/{id}/clase",
 *     summary="Obtener las clases de un curso",
 *     description="Devuelve las clases relacionadas con el curso para un usuario autenticado.",
 *     tags={"Cursos"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del curso",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Listado de clases del curso",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Listado de clases del curso"),
 *             @OA\Property(property="curso", type="object", example={"id": 1, "nombre": "Curso de Matemáticas"}),
 *             @OA\Property(property="clases", type="array", @OA\Items(type="object", example={"id": 1, "nombre": "Clase 1"}))
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autenticado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="No autenticado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Curso no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Curso no encontrado")
 *         )
 *     )
 * )
 */
  public function clasesIndex($id, Request $request) {
    if (!$this->user_auth) {
        return response()->json([
            'message' => 'No autenticado',
        ], 401);
    }

    // Obtener los cursos relacionados con el usuario
    $curso = Espacio::with(['clases'])->where('id_usuario', $this->user_auth->id)->find($id);

    if (!$curso) {
        return response()->json([
            'message' => 'Curso no encontrado',
        ], 404);
    }
    return response()->json(['message' => 'Listado de clases del curso','curso' => $curso->to_raw(),'clases' => $curso->clases], 200);
  }




  /**
   * @OA\Post(
   *     path="/api/v1/cursos/{id}/clase",
   *     summary="Crear una nueva clase para un curso",
   *     tags={"Clases"},
   *     security={{ "bearerAuth": {} }},
   *     @OA\Parameter(
   *         name="id",
   *         in="path",
   *         required=true,
   *         description="ID del curso al que se le quiere agregar la clase",
   *         @OA\Schema(type="integer")
   *     ),
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             @OA\Property(property="fecha", type="string", format="date", example="2024-10-12"),
   *             @OA\Property(property="hora_inicio", type="string", format="time", example="10:00:00"),
   *             @OA\Property(property="hora_termino", type="string", format="time", example="12:00:00")
   *         )
   *     ),
   *     @OA\Response(
   *         response=201,
   *         description="Clase creada exitosamente",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Clase creada exitosamente"),
   *             @OA\Property(property="id", type="integer", example=1)
   *         )
   *     ),
   *     @OA\Response(
   *         response=401,
   *         description="No autenticado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="No autenticado")
   *         )
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="Curso no encontrado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Curso no encontrado")
   *         )
   *     )
   * )
   */
  public function clasesStore($id, Request $request) {
    if (!$this->user_auth) {
        return response()->json([
            'message' => 'No autenticado',
        ], 401);
    }

    // Obtener los cursos relacionados con el usuario
    $curso = Espacio::where('id_usuario', $this->user_auth->id)->find($id);

    if (!$curso) {
        return response()->json([
            'message' => 'Curso no encontrado',
        ], 404);
    }

    $fechaHora = $request->input('fecha');

    $clase = new ClaseEspacio();
    $clase->fecha = $fechaHora;
    $clase->id_espacio = $curso->id;
    $clase->id_usuario = $this->user_auth->id;
    $clase->hora_inicio = $request->input('hora_inicio');
    $clase->hora_termino = $request->input('hora_termino');

    $clase->codigo_web = $this->findCodigoClaseUpdate('codigo_web', 10);
    $clase->activo = true;
    $clase->save();

    return response()->json(['message' => 'Clase creada exitosamente','clase' => $clase, 'codigo_qr' =>  $clase->codigo_web], 201);
  }

    /**
   * @OA\Get(
   *     path="/api/v1/cursos/{id}/clases/{code}/asistentes",
   *     summary="Obtener historial de asistencia de una clase",
   *     tags={"Clases"},
   *     security={{ "bearerAuth": {} }},
   *     @OA\Parameter(
   *         name="id",
   *         in="path",
   *         required=true,
   *         description="ID del curso al que pertenece la clase",
   *         @OA\Schema(type="integer")
   *     ),
   *     @OA\Parameter(
   *         name="code",
   *         in="path",
   *         required=true,
   *         description="Código web de la clase",
   *         @OA\Schema(type="string", example="abc12345")
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Listado de asistencia a la clase",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Listado de asistencia a la clase"),
   *             @OA\Property(property="codigo", type="string", example="abc12345"),
   *             @OA\Property(property="clase", type="object",
   *                 @OA\Property(property="id", type="integer", example=1),
   *                 @OA\Property(property="nombre", type="string", example="Clase de Matemáticas"),
   *                 @OA\Property(property="fecha", type="string", format="date", example="2024-10-12")
   *             ),
   *             @OA\Property(property="total", type="integer", example=25),
   *             @OA\Property(property="asistencias", type="array",
   *                 @OA\Items(
   *                     @OA\Property(property="id", type="integer", example=1),
   *                     @OA\Property(property="nombre_estudiante", type="string", example="Juan Pérez"),
   *                     @OA\Property(property="hora_asistencia", type="string", format="time", example="10:00:00"),
   *                     @OA\Property(property="presente", type="boolean", example=true)
   *                 )
   *             )
   *         )
   *     ),
   *     @OA\Response(
   *         response=401,
   *         description="No autenticado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="No autenticado")
   *         )
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="Clase o curso no encontrado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Clase o curso no encontrado")
   *         )
   *     )
   * )
   */
  public function clasesAsistentes($id, $code) {
    if (!$this->user_auth) {
        return response()->json([
            'message' => 'No autenticado',
        ], 401);
    }

    // Obtener los cursos relacionados con el usuario
    $curso = Espacio::where('id_usuario', $this->user_auth->id)->find($id);
    $clase = ClaseEspacio::where('id_espacio', $curso->id)->where('codigo_web', $code)->first();

    return response()->json(
      [ 'message' => 'Listado de asistencia a la clase',
        'codigo' => $code,
        'clase' => $clase->to_raw(),
        'total' => $clase->asistencias->count(),
        'asistencias' => $clase->asistencias]
    , 200);
  }

    /**
   * @OA\Post(
   *     path="/api/v1/clases/{code}/asistencia",
   *     summary="Registrar asistencia a una clase",
   *     tags={"Asistencia"},
   *     security={{ "bearerAuth": {} }},
   *     @OA\Parameter(
   *         name="code",
   *         in="path",
   *         required=true,
   *         description="Código web de la clase",
   *         @OA\Schema(type="string", example="abc12345")
   *     ),
   *     @OA\Response(
   *         response=201,
   *         description="Asistencia registrada con éxito",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Asistencia registrada con éxito")
   *         )
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Asistencia ya registrada",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Ya has registrado tu asistencia")
   *         )
   *     ),
   *     @OA\Response(
   *         response=401,
   *         description="No autenticado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="No autenticado")
   *         )
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="Código de clase incorrecto o no matriculado en este espacio",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Código de clase incorrecto")
   *         )
   *     )
   * )
   */
  public function asistenciaStore(Request $request, $code) {
    if (!$this->user_auth) {
      return response()->json([
          'message' => 'No autenticado',
      ], 401);
    }

    $clase = ClaseEspacio::where('codigo_web', $code)->first();

    if (empty($clase)) {
      return response()->json(['message' => 'Código de clase incorrecto'], 404);
    }

    $matricula = MatriculaEspacio::where('id_estudiante', $this->user_auth->id)
                                ->where('id_espacio', $clase->espacio->id)
                                ->first();

    if (empty($matricula)) {
      // Si el usuario no está matriculado en el espacio, lo matriculamos automáticamente
      $matricula = new MatriculaEspacio();
      $matricula->id_estudiante = $this->user_auth->id;
      $matricula->id_espacio = $clase->id_espacio;
      $matricula->habilitado = 1;
      $matricula->activo = true;
      $matricula->save();
    }

    $asistencia = AsistenciaEspacio::where('id_clase_espacio', $clase->id)
                                  ->where('id_matricula_espacio', $matricula->id)
                                  ->first();

    if (!empty($asistencia)) {
      return response()->json(['message' => 'Ya has registrado tu asistencia'], 200);
    }

    $asistencia = new AsistenciaEspacio();
    $asistencia->fecha = date('Y-m-d');
    $asistencia->run = $this->user_auth->run;
    $asistencia->id_clase_espacio = $clase->id;
    $asistencia->id_matricula_espacio = $matricula->id;
    $asistencia->save();

    return response()->json(['message' => 'Asistencia registrada con éxito'], 201);
}

   // PRIVATE

  private function findCodigoUpdate($column, $max = 6) {
    $codigo =  "";
    $existe = true;
    while ($existe) {
      $codigo =  Str::random($max);
      $existe = Espacio::where($column, $codigo)->first();
    }

    return $codigo;
  }

  private function findCodigoClaseUpdate($column, $max = 6) {
    $codigo =  "";
    $existe = true;
    while ($existe) {
      $codigo =  Str::random($max);
      $existe = ClaseEspacio::where($column, $codigo)->first();
    }

    return $codigo;
  }
}

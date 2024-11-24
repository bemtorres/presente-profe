<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\APIController;
use App\Models\AnuncioEspacio;
use App\Models\AsistenciaEspacio;
use App\Models\ClaseEspacio;
use App\Models\Espacio;
use App\Models\MatriculaEspacio;
use App\Models\ReporteInasistencia;
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
   * @OA\Get(
   *     path="/api/v1/estudiante/cursos",
   *     summary="Obtener cursos matriculados por el estudiante",
   *     tags={"Estudiante"},
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
  public function misCursos() {
    if (!$this->user_auth) {
      return response()->json([
        'message' => 'No autenticado',
      ], 401);
    }

    // Obtener los cursos relacionados con el usuario
    $matriculas = MatriculaEspacio::where('id_estudiante', $this->user_auth->id)->get();

    $toRawrValues = $matriculas->map(function ($matricula) {
      return $matricula->espacio->to_raw();
    });

    return response()->json([
        'message' => 'Success',
        'cursos' => $toRawrValues
    ], 200);
  }

  /**
   * @OA\Get(
   *     path="/api/v1/estudiante/cursos/{id}",
   *     summary="Obtener asistencia de un curso",
   *     tags={"Estudiante"},
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
   *         description="Asistencias del curso",
   *         @OA\JsonContent(
   *             @OA\Property(property="total_clases", type="integer", example=10, description="Total de clases del curso"),
   *             @OA\Property(property="total_asistencias", type="integer", example=8, description="Total de asistencias del estudiante"),
   *             @OA\Property(
   *                 property="historial_clases",
   *                 type="array",
   *                 @OA\Items(
   *                     @OA\Property(property="id", type="integer", example=1, description="ID de la clase"),
   *                     @OA\Property(property="nombre", type="string", example="Clase 1", description="Nombre de la clase"),
   *                     @OA\Property(property="hora_inicio", type="string", example="08:00:00", description="Hora de inicio de la clase"),
   *                     @OA\Property(property="hora_termino", type="string", example="09:30:00", description="Hora de término de la clase"),
   *                     @OA\Property(property="asistencia", type="boolean", example=true, description="Indica si el estudiante asistió a la clase"),
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
   *         response=403,
   *         description="Usuario no matriculado en el curso",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Usuario no está matriculado en este curso")
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

  //  :TODO EXAMINAR
  public function misCursoAsistencia($id) {
    if (!$this->user_auth) {
      return response()->json([
        'message' => 'No autenticado',
      ], 401);
    }

    $curso = Espacio::find($id);
    $clases = ClaseEspacio::where('id_espacio', $curso->id)->get();


    $matricula = MatriculaEspacio::where('id_espacio', $curso->id)
                              ->where('id_estudiante', $this->user_auth->id)->first();

    $asistencias = AsistenciaEspacio::where('id_matricula', $matricula->id)->get();

    $total_clases = $clases->count();
    $total_asistencias = $asistencias->count();

    $clases_dias = [];
    foreach ($clases as $clase) {
      $asiste = false;

      foreach ($asistencias as $asistencia) {
        if ($asistencia->id_clase_espacio == $clase->id) {
          $asiste = true;
          break;
        }
      }

      $clases_dias[] = [
        'id' => $clase->id,
        'nombre' => $clase->nombre,
        'hora_inicio' => $clase->hora_inicio,
        'hora_termino' => $clase->hora_termino,
        'asistencia' => $asiste,
      ];
    }

    $respuesta = [
      'total_clases' => $total_clases,
      'total_asistencias' => $total_asistencias,
      'asistencias' => $asistencias,
      'historial_clases' => $clases_dias,
    ];

    return response()->json($respuesta, 200);
  }

  public function justificarStore($id, Request $request) {

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

    // // Validar los datos
    // $validatedData = $request->validate([
    //     'nombre' => 'required|string|max:255',
    //     'sigla' => 'required|string|max:50',
    //     'institucion' => 'required|string|max:255',
    //     'descripcion' => 'nullable|string',
    // ]);

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
 *     path="api/v1/cursos/{id}/anuncios",
 *     summary="Obtener anuncios de un curso específico",
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
 *         description="Listado de anuncios del curso",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Listado de anuncios del curso"),
 *             @OA\Property(property="curso", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="nombre", type="string", example="Curso de Laravel"),
 *                 @OA\Property(property="descripcion", type="string", example="Un curso para aprender Laravel"),
 *             ),
 *             @OA\Property(property="anuncios", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="id_espacio", type="integer", example=10),
 *                     @OA\Property(property="titulo", type="string", example="Nuevo anuncio"),
 *                     @OA\Property(property="mensaje", type="string", example="Clase suspendida el lunes"),
 *                     @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-18T10:00:00Z"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-18T12:00:00Z"),
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
 *         description="Curso no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Curso no encontrado")
 *         )
 *     )
 * )
 */
  public function anuncios($id) {
    if (!$this->user_auth) {
      return response()->json([
        'message' => 'No autenticado',
      ], 401);
    }
    // Obtener los cursos relacionados con el usuario
    $curso = Espacio::with(['anuncios'])->where('id_usuario', $this->user_auth->id)->find($id);

    if (!$curso) {
      return response()->json(['message' => 'Curso no encontrado',], 404);
    }

    $anuncios = [];
    foreach ($curso->anuncios as $anuncio) {
      if ($anuncio->activo && $anuncio->estado == 1) {
        $anuncios[] = $anuncio->to_raw();
      }
    }

    // anuncios
    $respuesta = [
      'message' => 'Listado de anuncios del curso',
      'curso' => $curso->to_raw(),
      'anuncios' => $anuncios
    ];

    return response()->json($respuesta, 200);
  }

  /**
   * @OA\Get(
   *     path="/api/v1/cursos/{id}/inasistencias",
   *     summary="Obtener reportes de inasistencias de un curso",
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
   *         description="Listado de inasistencias del curso",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Listado de inasistencias del curso"),
   *             @OA\Property(property="curso", type="object", description="Información del curso",
   *                 @OA\Property(property="id", type="integer", example=1),
   *                 @OA\Property(property="nombre", type="string", example="Curso de Matemáticas"),
   *                 @OA\Property(property="descripcion", type="string", example="Curso avanzado de matemáticas"),
   *             ),
   *             @OA\Property(property="reportes", type="array",
   *                 @OA\Items(
   *                     @OA\Property(property="id", type="integer", example=5, description="ID de la matrícula"),
   *                     @OA\Property(property="estudiante", type="object",
   *                         @OA\Property(property="id", type="integer", example=2),
   *                         @OA\Property(property="nombre", type="string", example="Juan Pérez"),
   *                         @OA\Property(property="email", type="string", example="juan.perez@example.com")
   *                     ),
   *                     @OA\Property(property="cantidad_reporte", type="integer", example=2, description="Cantidad de reportes de inasistencia"),
   *                     @OA\Property(property="inasistencias", type="array",
   *                         @OA\Items(
   *                             @OA\Property(property="id", type="integer", example=10),
   *                             @OA\Property(property="fecha_inicio", type="string", format="date", example="2024-11-18"),
   *                             @OA\Property(property="mensaje", type="string", example="Razones médicas"),
   *                         )
   *                     )
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
   *         description="Curso no encontrado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Curso no encontrado")
   *         )
   *     )
   * )
   */
  public function inasistencias($id) {
    if (!$this->user_auth) {
      return response()->json([
        'message' => 'No autenticado',
      ], 401);
    }
    // Obtener los cursos relacionados con el usuario
    $curso = Espacio::with(['matriculas.reportes','matriculas.estudiante'])->where('id_usuario', $this->user_auth->id)->find($id);

    if (!$curso) {
      return response()->json(['message' => 'Curso no encontrado',], 404);
    }

    $reportes = [];
    foreach ($curso->matriculas as $ma) {
      if ($ma->activo && $ma->habilitado) {
        $reportes[] = [
          'id' => $ma->id,
          'estudiante' => $ma->estudiante->to_raw(),
          'cantidad_reporte' => $ma->reportes->count() ?? 0,
          'inasistencias' => $ma->reportes ?? [],
        ];
      }
    }

    // anuncios
    $respuesta = [
      'message' => 'Listado de anuncios del curso',
      'curso' => $curso->to_raw(),
      'reportes' => $reportes
    ];

    return response()->json($respuesta, 200);
  }

  /**
   * @OA\Post(
   *     path="/api/v1/cursos/{id}/anuncios",
   *     summary="Crear un nuevo anuncio para un curso",
   *     tags={"Cursos"},
   *     security={{"bearerAuth":{}}},
   *     @OA\Parameter(
   *         name="id",
   *         in="path",
   *         description="ID del curso",
   *         required=true,
   *         @OA\Schema(type="integer")
   *     ),
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             required={"titulo", "mensaje"},
   *             @OA\Property(property="titulo", type="string", example="Nuevo anuncio", description="Título del anuncio"),
   *             @OA\Property(property="mensaje", type="string", example="Este es un anuncio importante.", description="Contenido del anuncio"),
   *         )
   *     ),
   *     @OA\Response(
   *         response=201,
   *         description="Anuncio creado exitosamente",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Anuncio creado exitosamente"),
   *             @OA\Property(property="anuncio", type="object",
   *                 @OA\Property(property="id", type="integer", example=1),
   *                 @OA\Property(property="id_espacio", type="integer", example=1),
   *                 @OA\Property(property="titulo", type="string", example="Nuevo anuncio"),
   *                 @OA\Property(property="mensaje", type="string", example="Este es un anuncio importante."),
   *                 @OA\Property(property="activo", type="boolean", example=true),
   *                 @OA\Property(property="estado", type="integer", example=1),
   *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-18T10:00:00Z"),
   *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-18T10:00:00Z"),
   *             )
   *         )
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="Curso no encontrado",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Curso no encontrado")
   *         )
   *     ),
   *     @OA\Response(
   *         response=422,
   *         description="Errores de validación",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="The given data was invalid."),
   *             @OA\Property(property="errors", type="object", example={
   *                 "titulo": {"El campo título es obligatorio."},
   *                 "mensaje": {"El campo mensaje es obligatorio."}
   *             })
   *         )
   *     )
   * )
   */
  public function anunciosStore(Request $request, $id) {
    $curso = Espacio::with(['anuncios'])->where('id_usuario', $this->user_auth->id)->find($id);

    if (!$curso) {
      return response()->json(['message' => 'Curso no encontrado',], 404);
    }

    $anuncio = new AnuncioEspacio();
    $anuncio->id_espacio = $curso->id;
    $anuncio->titulo = $request->input('titulo');
    $anuncio->mensaje = $request->input('mensaje');
    $anuncio->activo = true;
    $anuncio->estado = 1;
    $anuncio->save();

    // Responder con el anuncio creado
    return response()->json([
        'message' => 'Anuncio creado exitosamente',
        'anuncio' => $anuncio,
    ], 201);
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
   *     path="/api/v1/cursos/{id}/clase/{code}",
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

    $alumnos =  [];
    // foreach ($clases->inaistencias )


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


  /**
   * @OA\Post(
   *     path="api/v1/estudiante/cursos/{id}/reportar-inasistencia",
   *     summary="Reportar una inasistencia para un curso",
   *     tags={"Estudiante"},
   *     security={{"bearerAuth":{}}},
   *     @OA\Parameter(
   *         name="id",
   *         in="path",
   *         description="ID del curso",
   *         required=true,
   *         @OA\Schema(type="integer")
   *     ),
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(
   *             required={"fecha", "mensaje"},
   *             @OA\Property(property="fecha", type="string", format="date", example="2024-11-18", description="Fecha de la inasistencia"),
   *             @OA\Property(property="mensaje", type="string", example="Razones médicas", description="Razón o mensaje explicando la inasistencia")
   *         )
   *     ),
   *     @OA\Response(
   *         response=201,
   *         description="Inasistencia reportada exitosamente",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Inasistencia reportada"),
   *             @OA\Property(property="reporte", type="object",
   *                 @OA\Property(property="id", type="integer", example=1, description="ID del reporte"),
   *                 @OA\Property(property="fecha_inicio", type="string", format="date", example="2024-11-18", description="Fecha de inicio de la inasistencia"),
   *                 @OA\Property(property="mensaje", type="string", example="Razones médicas", description="Mensaje del reporte"),
   *                 @OA\Property(property="id_matricula_espacio", type="integer", example=5, description="ID de la matrícula asociada"),
   *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-18T12:00:00Z", description="Fecha de creación del reporte"),
   *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-18T12:00:00Z", description="Última fecha de actualización del reporte")
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
   *         description="Curso o matrícula no encontrados",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Curso no encontrado")
   *         )
   *     ),
   *     @OA\Response(
   *         response=500,
   *         description="Error interno al reportar inasistencia",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Error al reportar inasistencia")
   *         )
   *     )
   * )
   */

  public  function reportarInasistencia(Request $request, $id){
    if (!$this->user_auth) {
      return response()->json([
          'message' => 'No autenticado',
      ], 401);
    }

    try {
      $fecha = $request->input('fecha');
      $mensaje = $request->input('mensaje');

      $curso = Espacio::find($id);

      if (!$curso) {
        return response()->json(['message' => 'Curso no encontrado'], 404);
      }

      $matricula = MatriculaEspacio::where('id_estudiante', $this->user_auth->id)->where('id_espacio', $curso->id)->first();

      if (!$matricula) {
        return response()->json(['message' => 'Usuario no está matriculado en este curso'], 403);
      }

      $reporte = new ReporteInasistencia();
      $reporte->fecha_inicio = $fecha;
      $reporte->mensaje = $mensaje;
      $reporte->id_matricula_espacio = $matricula->id;
      $reporte->save();

      return response()->json(['message' => 'Inasistencia reportada', 'reporte' => $reporte], 201);
    } catch (\Throwable $th) {
      return response()->json(['message' => 'Error al reportar inasistencia'], 500);
    }
  }

  public function anunciosEstudiante($id) {
    // anuncios del curso del estudiante
    if (!$this->user_auth) {
      return response()->json([
        'message' => 'No autenticado',
      ], 401);
    }
    // Obtener los cursos relacionados con el usuario
    $curso = Espacio::with(['anuncios'])->find($id);
    // ordenar por el mas nuevo

    if (!$curso) {
      return response()->json(['message' => 'Curso no encontrado',], 404);
    }

    $anuncios = [];
    foreach ($curso->anuncios as $anuncio) {
      if ($anuncio->activo && $anuncio->estado == 1) {
        $anuncios[] = $anuncio->to_raw();
      }
    }

    // anuncios
    $respuesta = [
      'message' => 'Listado de anuncios del curso',
      'curso' => $curso->to_raw(),
      'anuncios' => $anuncios
    ];

    return response()->json($respuesta, 200);
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

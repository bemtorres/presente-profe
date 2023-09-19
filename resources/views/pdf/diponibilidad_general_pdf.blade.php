@php
  function selectColor($calendar, $modulo, $dia) {
    if ($calendar[$modulo]['dias'][$dia]['selected']) {
      if ($calendar[$modulo]['dias'][$dia]['color'] == 1) {
        return 'verde';
      }
      return 'amarillo';
    }

    return '';
  }
@endphp
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DISPONIBILIDAD_HORARIA_{{ $plan->nombre }}</title>
  <style type="text/css">
    * {
      margin: 0;
      padding: 0;
      text-indent: 0;
    }

    .s1 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 8pt;
    }

    .s2 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 6pt;
    }

    table,
    tbody {
      vertical-align: top;
      overflow: visible;
    }

    .custom {
      border-top-style:solid;
      border-top-width:1pt;
      border-left-style:solid;
      border-left-width:1pt;
      border-bottom-style:solid;
      border-bottom-width:1pt;
      border-right-style:solid;
      border-right-width:1pt;
    }

    .br {
      margin-top: 5px !important;
    }

    .fondo-verde {
      background-color: #2eb85c;
    }

    .fondo-amarillo {
      background-color: #f9b115;
    }

    .centro {
      margin-left: auto;
      margin-right: auto;
    }

    .col-1 {
      width: 42pt;
    }

    .col-2 {
      width: 80pt;
    }

    .col-3 {
      width: 125pt;
    }

    .col-4 {
      width: 125pt;
    }

    .col-6 {
      width: 250pt;
    }

    .col-7 {
      width: 292pt;
    }

    .col-8 {
      width: 334pt;
    }

    .col-12 {
      width: 500pt;
    }

    /* ELEMENTOS PDFDOM */
    .page_break { page-break-before: always; }
  </style>

  {{-- table centro --}}
</head>
<body>
  @foreach ($data as $keyD => $d)
    @php
      $u = $d['u'];
      $calendario = $d['calendario'];
      $asignaturas_preferidas = $d['asignaturas_preferidas'];
      $horarios = $d['horarios'];
    @endphp
    <br>
    <br>
    <br>

    <div class="centro">
      <center>
        <strong>DISPONIBILIDAD HORARIA</strong>
      </center>
    </div>
    <br>
    <table style="border-collapse:collapse;" class="centro" cellspacing="0">
      <tr>
        <td class="custom col-6">
          <p style="text-indent: 0pt;text-align: center;">
            Nombre: {{ $u->nombre_completo() }}
          </p>
        </td>

        <td class="custom col-6">
          <p style="text-indent: 0pt;text-align: center;">
            Correo: {{ $u->correo }}
          </p>
        </td>
      </tr>
    </table>
    <br>
    {{-- tamaño de 500 --}}
    <table style="border-collapse:collapse;" class="centro" cellspacing="0">
      <tr>
        {{-- <td class="custom col-1">
          <p style="text-indent: 0pt;text-align: center;">
            Preferencia
          </p>
        </td> --}}
        <td class="custom col-1">
          <p style="text-indent: 0pt;text-align: center;">
            Nivel
          </p>
        </td>
        <td class="custom col-4">
          <p style="text-indent: 0pt;text-align: center;">
            Código
          </p>
        </td>
        <td class="custom col-6">
          <p style="text-indent: 0pt;text-align: center;">
            Asignatura
          </p>
        </td>
      </tr>
      @foreach ($asignaturas_preferidas as $item)
      <tr>
        <td class="custom col-1">
          <p style="text-indent: 0pt;text-align: center;">
            {{ $item->asignatura->semestre }}
          </p>
        </td>
        <td class="custom col-4">
          <p style="text-indent: 0pt;text-align: center;">
            {{ $item->asignatura->sigla }}
          </p>
        </td>
        <td class="custom col-6">
          <p style="text-indent: 0pt;text-align: center;">
            {{ $item->asignatura->nombre }}
          </p>
        </td>
      </tr>
      @endforeach
    </table>

    <br>

    <table style="border-collapse:collapse;" class="centro" cellspacing="0">
      <tr>
        <td style="width:58pt;" colspan="2" class="custom">
          <p class="s1" style="padding-top: 7pt;padding-left: 7pt;text-indent: 0pt;text-align: center;">Módulo</p>
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: center;" class=""><strong>Lunes</strong></p>
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: center;"><strong>Martes</strong></p>
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: center;"><strong>Miércoles</strong></p>
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: center;"><strong>Jueves</strong></p>
          {{-- <p class="s2" style="padding-top: 1pt;padding-left: 13pt;padding-right: 9pt;text-indent: 0pt;text-align: center;">
            ASY4131-012D(P)-ARQUITECTURA
          </p> --}}
          {{-- <p class="s2"
            style="padding-top: 1pt;padding-left: 13pt;padding-right: 9pt;text-indent: 0pt;text-align: center;">SJ-L804
          </p> --}}
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: center;"><strong>Viernes</strong></p>
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: center;"><strong>Sábado</strong></p>
        </td>
      </tr>

      @foreach ($horarios as $keyModulo => $h)
        <tr>
          <td style="width:29pt;" class="custom">
            <p class="s1" style="padding-top: 7pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">{{ $keyModulo + 1 }}</p>
          </td>
          <td style="width:43pt;" class="custom">
            <p class="s2" style="padding-top: 1pt;padding-left: 13pt;padding-right: 13pt;text-indent: 0pt;text-align: center;">{{$h[0]}}</p>
            <p class="s2" style="padding-left: 13pt;padding-right: 13pt;text-indent: 0pt;line-height: 119%;text-align: center;">A {{$h[1]}}</p>
          </td>

          @for ($dia = 1; $dia <= 6; $dia++)
          <td style="width:70pt;" class="custom fondo-{{ selectColor($calendario,$keyModulo + 1, $dia) }}">
            <p style="text-indent: 0pt;text-align: left;" class=""><br />
            {{-- {{ ' - ' . $keyModulo + 1 . ' - ' .  $dia }}</p> --}}
            {{-- @if ($calendario[$keyModulo + 1]['dias'][$dia]['selected']) --}}
              {{-- {{ $calendario[$keyModulo + 1]['dias'][$dia]['color'] }} --}}
            {{-- @endif --}}
          </td>
            {{-- @foreach ($mis_horarios as $keyMH => $mh)
              @if ($mh->dd == $dia && $mh->modulo == $keyModulo )
              @else
                <td style="width:70pt;" class="custom">
                  <p style="text-indent: 0pt;text-align: left;" class=""><br /></p>
                </td>
              @endif
            @endforeach --}}
          @endfor
          {{-- <td style="width:70pt;" class="custom">
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p class="s2" style="padding-top: 1pt;padding-left: 13pt;padding-right: 9pt;text-indent: 0pt;text-align: center;">
              ASY4131-012D(P)-ARQUITECTURA
            </p>
            <p class="s2"
              style="padding-top: 1pt;padding-left: 13pt;padding-right: 9pt;text-indent: 0pt;text-align: center;">SJ-L804
            </p>
          </td> --}}
        </tr>
      @endforeach
    </table>

    @if ($keyD != count($data) - 1)
      <div class="page_break"></div>
    @endif
  @endforeach
</body>
</html>

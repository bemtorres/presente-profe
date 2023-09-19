<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>file_1695087659995</title>
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
      background-color: #00ff00;
    }

    .fondo-amarillo {
      background-color: #ffff00;
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
          Nombre: BENJAMIN MORA
        </p>
      </td>

      <td class="custom col-6">
        <p style="text-indent: 0pt;text-align: center;">
          CORREO: BEJ.MORA@PROFESOR.DUOC.CL
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
    <tr>
      <td class="custom col-1">
        <p style="text-indent: 0pt;text-align: center;">
          1
        </p>
      </td>
      <td class="custom col-4">
        <p style="text-indent: 0pt;text-align: center;">
          ASYSSACAD
        </p>
      </td>
      <td class="custom col-6">
        <p style="text-indent: 0pt;text-align: center;">
          ARQUITECTURA DE COMPUTADORES
        </p>
      </td>
    </tr>
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
    @for ($i=1 ; $i < 20 ; $i++)
      <tr>
        <td style="width:29pt;" class="custom">
          <p class="s1" style="padding-top: 7pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">{{ $i }}</p>
        </td>
        <td style="width:43pt;" class="custom">
          <p class="s2" style="padding-top: 1pt;padding-left: 13pt;padding-right: 13pt;text-indent: 0pt;text-align: center;">18:11</p>
          <p class="s2" style="padding-left: 13pt;padding-right: 13pt;text-indent: 0pt;line-height: 119%;text-align: center;">A 18:50</p>
        </td>
        <td style="width:70pt;" class="custom fondo-verde">
          <p style="text-indent: 0pt;text-align: left;" class=""><br /></p>
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: left;"><br /></p>
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: left;"><br /></p>
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: left;"><br /></p>
          {{-- <p class="s2" style="padding-top: 1pt;padding-left: 13pt;padding-right: 9pt;text-indent: 0pt;text-align: center;">
            ASY4131-012D(P)-ARQUITECTURA
          </p> --}}
          {{-- <p class="s2"
            style="padding-top: 1pt;padding-left: 13pt;padding-right: 9pt;text-indent: 0pt;text-align: center;">SJ-L804
          </p> --}}
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: left;"><br /></p>
        </td>
        <td style="width:70pt;" class="custom">
          <p style="text-indent: 0pt;text-align: left;"><br /></p>
        </td>
      </tr>
    @endfor
  </table>


  {{-- <br class="br"> --}}
  {{-- <p style="text-indent: 0pt;text-align: left;"></p> --}}
  {{-- <table style="border-collapse:collapse;margin-left:8.67pt" cellspacing="0">
    <tr>
      <td style="width:29pt;" class="custom">
        <p class="s1" style="padding-top: 7pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">14</p>
      </td>
      <td style="width:43pt;" class="custom">
        <p class="s2"
          style="padding-top: 1pt;padding-left: 13pt;padding-right: 13pt;text-indent: 0pt;text-align: center;">18:11</p>
        <p class="s2"
          style="padding-left: 13pt;padding-right: 13pt;text-indent: 0pt;line-height: 119%;text-align: center;">A 18:50
        </p>
      </td>
      <td style="width:70pt;" class="custom">
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
      </td>
      <td style="width:70pt;" class="custom">
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
      </td>
      <td style="width:80pt;" class="custom">
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
      </td>
      <td style="width:70pt;" class="custom">
        <p class="s2"
          style="padding-top: 1pt;padding-left: 13pt;padding-right: 9pt;text-indent: 0pt;text-align: center;">
          ASY4131-012D(P)-ARQUITECTURA</p>
        <p class="s2"
          style="padding-top: 1pt;padding-left: 13pt;padding-right: 9pt;text-indent: 0pt;text-align: center;">SJ-L804
        </p>
      </td>
      <td style="width:70pt;" class="custom">
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
      </td>
      <td style="width:70pt;" class="custom">
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
      </td>
    </tr>
  </table> --}}
  {{-- <p style="text-indent: 0pt;text-align: left;"><br /></p> --}}
</body>
</html>

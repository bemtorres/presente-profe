@extends('layouts.webapp_alumno.skeleton')
@section('app')
@include('layouts.webapp_alumno._header')
<div class="container-xl pt-4 mb-5">
  @yield('content')
</div>
@include('webapp_alumno._modal_presente')
@include('webapp_alumno._modal_perfil')
@endsection

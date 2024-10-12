@extends('layouts.webapp_docente.skeleton')
@section('app')
@include('layouts.webapp_docente._header')
<div class="container-xl pt-4 mb-5">
  @yield('content')
</div>
@include('webapp_docente._modal_presente')
@include('webapp_docente._modal_perfil')
@endsection

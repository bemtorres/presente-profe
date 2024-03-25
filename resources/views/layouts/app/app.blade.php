@extends('layouts.app.skeleton')
@section('app')
@include('layouts.app._header')
<div class="container-xl pt-4 mb-5">
  @yield('content')
</div>
@endsection

@extends('layouts.app')
@section('css')

@endsection
@section('content')
@component('components.button._back')
  @slot('body','<strong>Bienvenidos a Comparte Duoc</strong>')
@endcomponent
<div class="row">



  <form action="{{ 'home' }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file">
    <button type="submit">Procesar Excel</button>
  </form>
</div>
@endsection

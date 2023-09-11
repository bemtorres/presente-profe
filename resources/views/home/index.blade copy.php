@extends('layouts.app')

@section('css')

<style>
  .item-selected:hover{
    background: #070606;
  }
</style>

@endsection

@section('content')

<h1>
  Mis horarios
</h1>
<div class="row">
  <div class="col-md-9">
    <div class="card">
      <div class="card-body">
        <calendario :horarios=@json($horarios)></calendario>
      </div>
    </div>
  </div>
</div>

@endsection

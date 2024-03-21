@extends('layouts.app')
@section('content')


<div class="row g-3 mb-4 align-items-center justify-content-between">
  @component('components.button._back')
    @slot('body', 'Usuario ' . $u->nombre_completo())
    @slot('route', route('admin.usuario.index'))
  @endcomponent
</div>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(['admin/usuarios/' . $u->id]) }}" aria-current="page" href="{{ route('admin.usuario.show', $u->id) }}">Usuario</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(['admin/usuarios/' . $u->id . '/edit']) }}" href="{{ route('admin.usuario.edit', $u->id) }}">Editar</a>
  </li>
</ul>
<div class="card text-start">
  <div class="card-body">

  </div>
</div>
@endsection

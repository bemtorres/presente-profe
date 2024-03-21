@extends('layouts.app')
@section('content')


<div class="row g-3 mb-4 align-items-center justify-content-between">
  @component('components.button._back')
    @slot('body', 'Usuarios')
    @slot('url_btn', route('admin.usuario.create'))
    @slot('url_text', 'Añadir Usuario')
  @endcomponent
</div>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(['admin/usuarios']) }}" aria-current="page" href="{{ route('admin.usuario.index') }}">Admin</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(['admin/usuarios_premium']) }}" href="{{ route('admin.usuario.premium') }}">Premiums</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(['admin/usuarios_normal']) }}" href="{{ route('admin.usuario.normal') }}">Usuarios</a>
  </li>
</ul>
<div class="card text-start">
  <div class="card-body">
    <div class="table-responsive ">
      <table class="table app-table-hover table-sm mb-0 text-left">
        <thead>
          <tr>
            {{-- <th class="cell">Order</th> --}}
            <th class="cell">Nombre</th>
            <th class="cell">Correo</th>
            <th class="cell">Date</th>
            <th class="cell">Status</th>
            <th class="cell">Total</th>
            <th class="cell"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($usuarios as $u)
            <tr>
              {{-- <td class="cell">#15346</td> --}}
              <td class="cell">{{ $u->nombre_completo() }}</td>
              <td class="cell"><a href="{{ route('admin.usuario.show', $u->id) }}">{{ $u->correo }}</a></td>
              <td class="cell"><span>17 Oct</span><span class="note">2:16 PM</span></td>
              <td class="cell"><span class="badge bg-success">Paid</span></td>
              <td class="cell">$259.35</td>
              <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>






@endsection

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes"]) }}" href="{{ route('planes.index') }}">Planes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/create"]) }}" href="{{ route('planes.create') }}">Nuevo</a>
  </li>
</ul>

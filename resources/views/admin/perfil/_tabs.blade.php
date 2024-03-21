<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(['admin/perfil']) }}" aria-current="page" href="{{ route('admin.perfil.index') }}">Mi cuenta</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ activeTab(['admin/perfil/invitar']) }}" href="{{ route('admin.perfil.invitar') }}">Invitar</a>
  </li>
</ul>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ activeTab(["planes/".$plan->id."/participantes/".$asociado->id]) }}" href="{{ route('planes.participantes.show', [$plan->id, $asociado->id]) }}">Participante</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  {{ activeTab(["planes/".$plan->id."/participantes/".$asociado->id. "/pdf"]) }}" href="{{ route('planes.participantes.showPDF', [$plan->id, $asociado->id]) }}">VER PDF</a>
  </li>
</ul>

                {{-- <a href="{{ route('pdf.diponibilidad', [$plan->id, $asociado->id]) }}" class="btn btn-danger">VER PDF</a> --}}


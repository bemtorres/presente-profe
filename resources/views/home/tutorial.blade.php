@extends('layouts.app')
@section('css')
<style>
  .embed-responsive {
  position: relative;
  display: block;
  width: 100%;
  padding: 0;
  overflow: hidden;
}

.embed-responsive::before {
  display: block;
  content: "";
}

.embed-responsive.embed-responsive-16by9::before {
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
}

.embed-responsive .embed-responsive-item,
.embed-responsive iframe,
.embed-responsive embed,
.embed-responsive object,
.embed-responsive video {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
}

</style>
@endsection
@section('content')
@component('components.button._back')
  @slot('body','<strong>Tutoriales</strong>')
  @slot('icon', 'fa-brands fa-youtube icon me-2 text-danger')
@endcomponent


<div class="row justify-content-center">
  {{-- <div class="col-md-12 text-center mb-3">
    <a href="{{ route('pdf.diponibilidad', [$plan->id, $asociado->id]) }}" class="btn btn-danger btn-sm text-white"><i class="fa fa-file-pdf me-2"></i><strong>VER PDF</strong></a>
  </div> --}}
  <div class="col-md-12">
    <div class="card text-start">
      <div class="card-body">
        <h4 class="card-title">¿Como utilizar <strong>disponibilidad horaria</strong>?</h4>
        <div class="embed-responsive embed-responsive-16by9">
          <iframe height="450" width="800" class="embed-responsive-item" src="https://www.youtube.com/embed/4W1HmF-G4es?si=Htq5A1qHdLwfJoFC" allowfullscreen></iframe>
        </div>

        <h4 class="card-title mt-3">Ver PDF</h4>

        <iframe src="{{ asset('template/pdf/manual_de_usuario_para_Inscripción_AP.pdf') }}" style="width:100%; height:700px;" frameborder="0" ></iframe>

      </div>
    </div>
  </div>
</div>
@endsection

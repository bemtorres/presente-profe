@extends('layouts.app')
@section('css')

@endsection
@section('content')
<div class="row">
  <div class="col-md-8 row">
    <div class="col-12">
      <div class="card shadow mb-3">
        <div class="card-body px-3">
          <h2 class="display-6 fw-bold">Hola {{ current_user()->nombre }}! 🖐️</h2>
          <h5 class="card-title">Te damos la bienvenida ¡Comparte Duoc!</h5>
          <p class="lead">Transformando el panorama educativo: maximiza la eficiencia, fomenta la colaboración y libera el potencial de cada aula.
          </p>
          <p class="text-center">
            <strong>¡Descubre, reserva y conecta con Comparte Duoc!</strong>
          </p>

          <div class="">
            <div class="col-lg-6 mx-auto">
              <p class="lead mb-4">
              </p>
              <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-3">

                @if (current_user()->admin)
                  <a href="{{ route('app.sede', $sede->id) }}" class="btn btn-primary btn-lg px-4 me-sm-3">Salas</a>
                @endif

                <a href="{{ route('app.sede.usuario', $sede->id) }}" class="btn btn-primary btn-lg px-4 me-sm-3">Agendar Sala</a>
                <a href="{{ route('solicitud.me') }}" class="btn btn-outline-secondary btn-lg px-4">Mis Solicitudes</a>
              </div>
            </div>
            <div class="overflow-hidden" style="max-height: 30vh;">
              <div class="container px-5">
                <img src="{{ $sede->getImg() }}" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card shadow mb-2">
        {{-- <img src="imagen_anuncio_5.jpg" class="card-img-top" alt="Anuncio 5"> --}}
        <div class="card-body">
          <h5 class="card-title">Tu Espacio, Tu Horario, Tu Elección</h5>
          <p class="card-text">Docentes y administrativos, ¿cansados de horarios complicados? Reserva tus espacios educativos en tus términos. ¡Tu espacio, tu horario, tu elección!</p>
          <div class="d-grid">
            <a href="#" class="btn btn-primary">Descarga la App 📲</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card shadow mb-2">
        <img src="{{ asset('template/img/info/pexels-fauxels-3183197.jpg') }}"  class="card-img-top" alt="Anuncio 2">
        <div class="card-body">
          <h5 class="card-title">Transforma Tu Manera de Enseñar y Aprender</h5>
          <p class="card-text">Descubre la innovadora herramienta de agendamiento creada en colaboración con el CITT, diseñada para docentes y administrativos de Duoc UC. ¡Reserva salas estratégicas con facilidad y eficiencia!</p>
          {{-- <a href="#" class="btn btn-primary">Más información</a> --}}
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 row">
    <div class="col-12">
      <div class="card shadow mb-2">
        <img src="{{ asset('template/img/info/duocuc.png') }}" class="card-img-top" alt="Anuncio 4">
        <div class="card-body">
          <h5 class="card-title">Libera el Potencial de tus Espacios Educativos</h5>
          <p class="card-text">Docentes y administrativos, ¡la solución para la gestión eficiente de espacios ha llegado! Reserva salas para recuperación de clases, reuniones productivas y capacitaciones inspiradoras. ¡Haz que cada espacio cuente!</p>
          {{-- <a href="#" class="btn btn-primary">Descubre Más</a> --}}
        </div>
      </div>
    {{-- </div>
    <div class="col-12"> --}}
      <div class="card shadow mb-2">
        <img src="{{ asset('template/img/info/pexels-cowomen-2041627.jpg') }}" class="card-img-top" alt="Anuncio 1">
        <div class="card-body">
          <h5 class="card-title">Optimiza tu Tiempo, Maximiza tu Espacio</h5>
          <p class="card-text">Descubre nuestra nueva plataforma web que te permite reservar espacios estratégicos para clases recuperativas, reuniones, capacitaciones ¡y más! ¡Comparte Duoc, maximiza el potencial de cada espacio y optimiza tu tiempo!</p>
          {{-- <a href="#" class="btn btn-primary">Regístrate ahora</a> --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

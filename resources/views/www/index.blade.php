@extends('www.app')
@push('stylesheet')
<style>
.form-control, .form-control:focus {
  background-color: #f4f4f4;
  border: 1px solid #ced4da;
}
</style>
@endpush
@section('content')
@include('www._nav')
@include('www._banner')

<div class="content-wrapper">
  <div class="container">
    @include('www._description')
    {{-- @include('www._segment_one') --}}
    {{-- @include('www._segment_two') --}}
    @include('www._pricing')
    {{-- @include('www._feedback') --}}
    {{-- @include('www._contact') --}}
    @include('www._footer')
  </div>
</div>
@endsection

@push('javascript')
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
  var typed = new Typed('.typed', {
    strings: [
      'puntos',
      'recompensas',
      'canjees'
    ],
  // stringsElement: '#typed-strings', // ID del elemento que contiene cadenas de texto a mostrar.
  typeSpeed: 95, // Velocidad en mlisegundos para poner una letra,
  startDelay: 300, // Tiempo de retraso en iniciar la animacion. Aplica tambien cuando termina y vuelve a iniciar,
  backSpeed: 95, // Velocidad en milisegundos para borrrar una letra,
  smartBackspace: true, // Eliminar solamente las palabras que sean nuevas en una cadena de texto.
  shuffle: false, // Alterar el orden en el que escribe las palabras.
  backDelay: 1500, // Tiempo de espera despues de que termina de escribir una palabra.
  loop: true, // Repetir el array de strings
  loopCount: false, // Cantidad de veces a repetir el array.  false = infinite
  showCursor: true, // Mostrar cursor palpitanto
  cursorChar: '|', // Caracter para el cursor
  contentType: 'html', // 'html' o 'null' para texto sin formato
});
</script>
@endpush

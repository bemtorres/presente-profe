<?php

use App\Models\GlobalAsignatura;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
      Schema::create('global_asignatura', function (Blueprint $table) {
        $table->id();
        $table->string('siglas')->nullable();
        $table->string('nombre');
        $table->string('descripcion')->nullable();
        $table->json('assets')->nullable();
        $table->timestamps();
      });

      GlobalAsignatura::create([
        'siglas' => 'FPY1101',
        'nombre' => 'Matemáticas',
        'descripcion' => 'Matemáticas',
        'assets' => json_encode([
          'icon' => 'fas fa-calculator',
          'color' => 'bg-blue-500',
          'img' => 'https://cdn.pixabay.com/photo/2013/07/13/12/47/math-160716_960_720.png'
        ])
      ],
      [
        'siglas' => 'MDY3131',
        'nombre' => 'Lenguaje',
        'descripcion' => 'Lenguaje',
        'assets' => json_encode([
          'icon' => 'fas fa-book',
          'color' => 'bg-red-500',
          'img' => 'https://cdn.pixabay.com/photo/2016/11/19/14/00/abstract-1837859_960_720.jpg'
        ])
      ]
    );

      Schema::create('globl_asignatura_semana', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_asignatura')->references('id')->on('global_asignatura');
        $table->integer('semana')->nullable(); // posicion semana 1 - 18
        $table->string('fechas')->nullable();
        $table->string('unidad')->nullable();
        $table->string('aprendizaje')->nullable();
        $table->json('actividades')->nullable();
        $table->string('metodologia')->nullable();
        $table->timestamps();
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignatura_global');
    }
};

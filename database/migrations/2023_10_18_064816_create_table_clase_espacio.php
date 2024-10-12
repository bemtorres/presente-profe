<?php

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
        Schema::create('clase_espacio', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_termino')->nullable();
            $table->foreignId('id_usuario')->references('id')->on('usuario');
            $table->foreignId('id_espacio')->references('id')->on('espacio');
            $table->json('info')->nullable();
            $table->string('codigo_web')->unique();
            $table->boolean('activo')->dafault(false);
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
        Schema::dropIfExists('clase_espacio');
    }
};

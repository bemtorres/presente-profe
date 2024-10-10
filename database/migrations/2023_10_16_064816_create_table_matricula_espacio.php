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
        Schema::create('matricula_espacio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_estudiante')->references('id')->on('usuario');
            $table->foreignId('id_espacio')->references('id')->on('espacio');
            $table->json('info')->nullable();
            $table->boolean('habilitado')->dafault(false);
            $table->boolean('activo')->dafault(true);
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
        Schema::dropIfExists('matricula_espacio');
    }
};

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
        Schema::create('reporte_inasistencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_matricula_espacio')->references('id')->on('matricula_espacio');
            $table->date('fecha_inicio');
            $table->string('mensaje');
            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('reporte_inasistencia');
    }
};

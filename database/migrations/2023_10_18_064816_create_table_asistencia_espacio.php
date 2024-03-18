<?php

use App\Models\Sala;
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
        Schema::create('asistencia_espacio', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('run')->nullable();
            $table->foreignId('id_matricula_espacio')->references('id')->on('matricula_espacio');
            $table->json('info')->nullable();
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
        Schema::dropIfExists('asistencia_espacio');
    }
};

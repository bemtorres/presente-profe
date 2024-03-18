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
        Schema::create('espacio', function (Blueprint $table) {
            $table->id();
            $table->string('periodo'); // "202302"
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->string('sigla')->nullable();
            $table->string('institucion')->nullable();
            $table->string('codigo_unirse')->unique();
            $table->string('codigo_registro')->unique();
            $table->integer('registro_activo')->default(true);
            $table->json('info')->nullable();
            $table->json('web')->nullable();
            $table->foreignId('id_usuario')->references('id')->on('usuario');
            $table->integer('activo')->default(true);
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
        Schema::dropIfExists('espacio');
    }
};

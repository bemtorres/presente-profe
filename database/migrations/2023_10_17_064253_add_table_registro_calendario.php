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
        Schema::create('registro_calendario', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->string('codigo')->nullable();
            $table->string('semestre')->nullable();
            $table->integer('modulo');
            $table->integer('semana');
            $table->foreignId('id_sede')->references('id')->on('sede');
            $table->foreignId('id_sala')->references('id')->on('sala');
            $table->foreignId('id_usuario')->references('id')->on('usuario');
            $table->integer('tipo')->default(0);
            $table->integer('estaddo')->default(0);
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
        Schema::dropIfExists('registro_calendario');
    }
};

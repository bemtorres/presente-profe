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
        Schema::create('aud_registro_calendario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sede')->references('id')->on('sede');
            $table->foreignId('id_solicitud')->references('id')->on('sala');
            $table->foreignId('id_devise')->references('id')->on('usuario');
            $table->foreignId('id_usuario')->references('id')->on('usuario');
            $table->integer('tipo')->default(1);
            $table->string('comentario')->nullable();
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
        Schema::dropIfExists('aud_registro_calendario');
    }
};

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
        Schema::create('solicitud', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sede')->references('id')->on('sede');
            $table->foreignId('id_sala')->references('id')->on('sala');
            $table->foreignId('id_usuario')->references('id')->on('usuario');
            $table->integer('id_revisor')->nullable();
            $table->integer('motivo')->default(0);
            $table->string('comentario')->nullable();
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
        Schema::dropIfExists('solicitud');
    }
};

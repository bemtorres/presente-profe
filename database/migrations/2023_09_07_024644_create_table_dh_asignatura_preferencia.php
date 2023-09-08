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
        Schema::create('dh_asignatura_preferencia', function (Blueprint $table) {
            $table->id();

            $table->integer('posicion');

            $table->unsignedBigInteger('id_plan')->nullable();
            $table->foreign('id_plan')->nullable()->references('id')->on('dh_plan');

            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->nullable()->references('id')->on('usuario');

            $table->integer('forma')->nullable();
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
        Schema::dropIfExists('dh_asignatura_preferencia');
    }
};

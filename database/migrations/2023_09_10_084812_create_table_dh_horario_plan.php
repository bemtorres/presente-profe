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
        Schema::create('dh_horario_plan', function (Blueprint $table) {
            $table->id();

            $table->integer('id_asociado_plan')->nullable(); // no se usa en caso que sea borrado

            $table->unsignedBigInteger('id_plan')->nullable();
            $table->foreign('id_plan')->nullable()->references('id')->on('dh_plan');

            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->nullable()->references('id')->on('usuario');

            $table->integer('dia');
            $table->integer('modulo');

            $table->integer('estado')->default(0);
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
        Schema::dropIfExists('dh_horario_plan');
    }
};

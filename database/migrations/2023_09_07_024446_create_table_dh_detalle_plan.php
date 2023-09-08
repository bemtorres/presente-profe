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
        Schema::create('dh_detalle_plan', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_plan')->nullable();
            $table->foreign('id_plan')->nullable()->references('id')->on('dh_plan');

            $table->unsignedBigInteger('id_asignatura')->nullable();
            $table->foreign('id_asignatura')->nullable()->references('id')->on('dh_asignatura');

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
        Schema::dropIfExists('dh_detalle_plan');
    }
};

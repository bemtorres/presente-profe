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
        Schema::create('calendario', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->string('periodo'); // "202302"
            $table->integer('semana');
            $table->integer('dia');
            $table->integer('modulo');
            $table->json('info')->nullable();
            $table->integer('tipo');
            $table->foreignId('id_sede')->references('id')->on('sede');
            $table->foreignId('id_sala')->references('id')->on('sala');
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
        Schema::dropIfExists('calendario');
    }
};

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
        Schema::table('dh_asignatura_preferencia', function (Blueprint $table) {
          $table->unsignedBigInteger('id_asignatura')->nullable()->after('id_usuario');
          $table->foreign('id_asignatura')->nullable()->references('id')->on('dh_asignatura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dh_asignatura_preferencia', function (Blueprint $table) {
          // $table->dropColumn(['posicion']);
        });
    }
};

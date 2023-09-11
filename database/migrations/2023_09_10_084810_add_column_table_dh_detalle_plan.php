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
        Schema::table('dh_detalle_plan', function (Blueprint $table) {
          $table->integer('posicion')->after('id_asignatura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dh_detalle_plan', function (Blueprint $table) {
          $table->dropColumn(['posicion']);
        });
    }
};

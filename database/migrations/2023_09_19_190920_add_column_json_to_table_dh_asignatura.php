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
        Schema::table('dh_asignatura', function (Blueprint $table) {
          $table->json('info')->nullable()->after('carrera');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dh_asignatura', function (Blueprint $table) {
          $table->dropColumn(['info']);
        });
    }
};

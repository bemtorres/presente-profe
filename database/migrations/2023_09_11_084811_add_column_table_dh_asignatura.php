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
          $table->string('programa')->after('id');
          $table->integer('semestre')->after('programa');
          // $table->unsignedBigInteger('id_asignatura')->nullable()->after('id_usuario');
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
          $table->dropColumn(['programa','semestre']);
        });
    }
};

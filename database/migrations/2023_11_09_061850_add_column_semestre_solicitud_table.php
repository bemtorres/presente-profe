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
        Schema::table('solicitud', function (Blueprint $table) {
          $table->string('periodo')->nullable()->after('estado'); // "202302"
          $table->integer('semana')->nullable()->after('periodo'); // ID SEMANA
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud', function (Blueprint $table) {
          $table->dropColumn('periodo');
          $table->dropColumn('semana');
        });
    }
};

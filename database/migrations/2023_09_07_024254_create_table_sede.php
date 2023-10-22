<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('sede', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('img')->nullable();
            $table->json('integrations')->nullable();
            $table->boolean('comparte')->default(false);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        DB::unprepared(file_get_contents('database/import/sql_sedes.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sede');
    }
};

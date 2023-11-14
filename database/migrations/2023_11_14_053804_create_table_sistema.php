<?php

use App\Models\Sistema;
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
        Schema::create('sistema', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->json('info')->nullable();
            $table->json('config')->nullable();
            $table->timestamps();
        });

        $s = new Sistema();
        $s->nombre = "Comparte duoc";
        $s->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sistema');
    }
};

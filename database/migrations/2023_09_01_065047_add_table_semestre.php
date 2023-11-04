<?php

use App\Models\Semestre;
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
        Schema::create('semestre', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->boolean('activo')->default(false);
            $table->timestamps();
        });

        $s = new Semestre();
        $s->codigo = '202301';
        $s->nombre = '2023-1';
        $s->save();

        $s = new Semestre();
        $s->codigo = '202302';
        $s->nombre = '2023-2';
        $s->activo = true;
        $s->save();

        $s = new Semestre();
        $s->codigo = '202401';
        $s->nombre = '2024-1';
        $s->save();

        $s = new Semestre();
        $s->codigo = '202402';
        $s->nombre = '2024-2';
        $s->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semestre');
    }
};

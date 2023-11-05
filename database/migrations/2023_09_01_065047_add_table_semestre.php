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
            $table->string('periodo')->unique();
            $table->string('nombre');
            $table->string('semestre');
            $table->boolean('activo')->default(false);
            $table->timestamps();
        });

        $s = new Semestre();
        $s->periodo = '202301';
        $s->nombre = '2023-01';
        $s->semestre = 1;
        $s->save();

        $s = new Semestre();
        $s->periodo = '202302';
        $s->nombre = '2023-02';
        $s->semestre = 2;
        $s->activo = true;
        $s->save();

        $s = new Semestre();
        $s->periodo = '2024TAV';
        $s->nombre = '2024-TAV';
        $s->semestre = 3;
        $s->save();

        $s = new Semestre();
        $s->periodo = '202401';
        $s->nombre = '2024-01';
        $s->semestre = 1;
        $s->save();

        $s = new Semestre();
        $s->periodo = '202402';
        $s->nombre = '2024-02';
        $s->semestre = 2;
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

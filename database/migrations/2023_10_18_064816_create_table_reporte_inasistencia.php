<?php

use App\Models\Sala;
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
        Schema::create('reporte_asistencia', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('descripcion')->nullable();
            $table->string('run')->nullable();
            $table->json('info')->nullable();
            $table->foreignId('id_curso')->references('id')->on('curso');
            $table->foreignId('id_matricula_curso')->references('id')->on('matricula_curso');
            $table->timestamps();
        });

        // for ($i=120; $i < 400; $i++) {
        //   $s = new Sala();
        //   $s->periodo = '202302';
        //   $s->nombre = 'sala ' . $i;
        //   $s->codigo = $i;
        //   $s->id_sede = 1300;
        //   $s->save();
        // }

        // for ($i=420; $i < 600; $i++) {
        //   $s = new Sala();
        //   $s->periodo = '202302';
        //   $s->nombre = 'sala ' . $i;
        //   $s->codigo = $i;
        //   $s->id_sede = 1000;
        //   $s->save();
        // }

        // for ($i=100; $i < 333; $i++) {
        //   $i = $i + 4;
        //   $s = new Sala();
        //   $s->periodo = '202302';
        //   $s->nombre = 'sala ' . $i;
        //   $s->codigo = $i;
        //   $s->id_sede = 800;
        //   $s->save();
        // }
      }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sala');
    }
};

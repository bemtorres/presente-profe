<?php

use App\Models\Semana;
use App\Models\Semestre;
use Carbon\Carbon;
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
        Schema::create('semana', function (Blueprint $table) {
          $table->id();
          $table->integer('posicion')->nullable();
          $table->integer('semana')->nullable();
          $table->string('nombre')->nullable();
          $table->date('fecha_inicio')->nullable();
          $table->date('fecha_termino')->nullable();
          $table->foreignId('id_semestre')->references('id')->on('semestre');
          $table->boolean('activo')->default(false);
          $table->timestamps();
        });

        $semanas = [
          ["SEMANA 1", "07-08-2023", "13-08-2023"],
          ["SEMANA 2", "14-08-2023", "20-08-2023"],
          ["SEMANA 3", "21-08-2023", "27-08-2023"],
          ["SEMANA 4", "28-08-2023", "03-09-2023"],
          ["SEMANA 5", "04-09-2023", "10-09-2023"],
          ["SEMANA 6", "11-09-2023", "17-09-2023"],
          ["SEMANA 7", "18-09-2023", "24-09-2023"],
          ["SEMANA 8", "25-09-2023", "01-10-2023"],
          ["SEMANA 9", "02-10-2023", "08-10-2023"],
          ["SEMANA 10", "09-10-2023", "15-10-2023"],
          ["SEMANA 11", "16-10-2023", "22-10-2023"],
          ["SEMANA 12", "23-10-2023", "29-10-2023"],
          ["SEMANA 13", "30-10-2023", "05-11-2023"],
          ["SEMANA 14", "06-11-2023", "12-11-2023"],
          ["SEMANA 15", "13-11-2023", "19-11-2023"],
          ["SEMANA 16", "20-11-2023", "26-11-2023"],
          ["SEMANA 17", "27-11-2023", "03-12-2023"],
          ["SEMANA 18", "04-12-2023", "10-12-2023"]
      ];

      $semestre = Semestre::where('codigo','202302')->first();

      foreach ($semanas as $sKey => $se) {
        $s = new Semana();
        $s->posicion = $sKey + 1;
        $s->semana = $sKey + 1;
        $s->fecha_inicio = $this->convertDateFormat($se[1]);
        $s->fecha_termino = $this->convertDateFormat($se[2]);
        $s->id_semestre = $semestre->id;
        $s->save();
      }

  }

  function convertDateFormat($dateString) {
    // Intentamos crear un objeto Carbon a partir de la fecha en formato "dd-mm-yyyy"
    $carbonDate = Carbon::createFromFormat('d-m-Y', $dateString);

    // Verificamos si la conversión fue exitosa
    if ($carbonDate) {
        // Devolvemos la fecha en formato "yyyy-mm-dd"
        return $carbonDate->toDateString();
    } else {
        // En caso de error en la conversión, devolvemos un mensaje de error
        return "Formato de fecha no válido";
    }
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semana');
    }
};

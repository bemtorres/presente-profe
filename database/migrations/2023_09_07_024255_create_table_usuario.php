<?php

use App\Models\Usuario;
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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('correo')->unique();
            $table->string('password', 255);
            $table->integer('tipo_usuario')->nullable();
            $table->json('info')->nullable();
            $table->json('integrations')->nullable();
            $table->timestamps();
        });


        $u = new Usuario();

        $u->nombre = 'admin';
        $u->apellido_paterno = 'admin';
        $u->apellido_materno = 'admin';
        $u->correo = 'admin@gmail.com';
        $u->password = hash('sha256', 'admin');
        $u->tipo_usuario = 1;
        $u->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
};

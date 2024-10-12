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
            $table->string('run')->nullable();
            $table->string('nombre');
            $table->string('nickname')->nullable();
            $table->string('apellido')->nullable();
            $table->string('correo')->unique();
            $table->string('password', 256);
            $table->string('remember_token')->nullable();
            $table->string('codigo_invitacion')->nullable();
            $table->string('imagen')->nullable();
            $table->integer('perfil')->default(3);
            $table->json('info')->nullable();
            $table->json('integrations')->nullable();
            $table->boolean('verificado')->default(false);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        $u = new Usuario();
        $u->nombre = 'Tomas';
        $u->apellido = 'Admin';
        $u->correo = 'admin@presenteprofe.cl';
        $u->password = hash('sha256', 'admin123');
        $u->codigo_invitacion = 'admin123';
        $u->perfil = 1;
        $u->verificado = true;
        $u->save();

        $u = new Usuario();
        $u->nombre = 'Benjamin';
        $u->apellido = 'profe';
        $u->correo = 'profesor@presenteprofe.cl';
        $u->password = hash('sha256', 'admin123');
        $u->perfil = 2;
        $u->verificado = true;
        $u->save();

        $u = new Usuario();
        $u->nombre = 'Elias';
        $u->apellido = 'alumno';
        $u->correo = 'estudiante@presenteprofe.cl';
        $u->password = hash('sha256', 'admin123');
        $u->perfil = 3;
        $u->verificado = true;
        $u->save();


        $u = new Usuario();
        $u->nombre = 'Elias';
        $u->apellido = 'torres';
        $u->correo = 'benja.mora.torres@gmail.com';
        $u->password = hash('sha256', 'admin123');
        $u->perfil = 2;
        $u->verificado = true;
        $u->save();

        $u = new Usuario();
        $u->nombre = 'Elias';
        $u->apellido = 'Mora';
        $u->correo = 'bej.mora@profesor.duoc.cl';
        $u->password = hash('sha256', 'admin123');
        $u->perfil = 3;
        $u->verificado = true;
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

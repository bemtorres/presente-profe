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
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('correo')->unique();
            $table->string('password', 256);
            $table->string('token')->nullable();
            $table->string('codigo_invitacion')->nullable();
            $table->string('imagen')->nullable();
            $table->boolean('premium')->default(false);
            $table->boolean('admin')->default(false);
            $table->json('info')->nullable();
            $table->json('integrations')->nullable();
            $table->boolean('verificado')->default(false);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });


        $u = new Usuario();
        $u->nombre = 'Benjamin';
        $u->apellido_paterno = 'Admin';
        $u->apellido_materno = 'Torres';
        $u->correo = 'admin@presenteprofe.cl';
        $u->password = hash('sha256', 'admin123');
        $u->codigo_invitacion = 'admin123';
        $u->admin = true;
        $u->premium = true;
        $u->verificado = true;
        $u->save();

        $u = new Usuario();
        $u->nombre = 'Benjamin';
        $u->apellido_paterno = 'Mora';
        $u->apellido_materno = 'Torres';
        $u->correo = 'profesor@presenteprofe.cl';
        $u->password = hash('sha256', 'admin123');
        $u->admin = false;
        $u->premium = true;
        $u->verificado = true;
        $u->save();

        $u = new Usuario();
        $u->nombre = 'Elias';
        $u->apellido_paterno = 'Torres';
        $u->apellido_materno = 'Torres';
        $u->correo = 'estudiante@presenteprofe.cl';
        $u->password = hash('sha256', 'admin123');
        $u->admin = false;
        $u->premium = false;
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

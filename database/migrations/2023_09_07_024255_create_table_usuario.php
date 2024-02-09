<?php

use App\Models\Usuario;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as FakerFactory;
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
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('correo')->unique();
            $table->string('password', 256);
            $table->string('imagen')->nullable();
            $table->boolean('admin')->default(false);
            $table->json('info')->nullable();
            $table->json('integrations')->nullable();
            $table->boolean('verificado')->default(false);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });


        $u = new Usuario();
        $u->nombre = 'Benjamin';
        $u->apellido_paterno = 'Mora';
        $u->apellido_materno = 'Torres';
        $u->correo = 'bej.mora@profesor.duoc.cl';
        $u->password = hash('sha256', '199191919192AASDDS');
        $u->admin = true;
        $u->verificado = true;
        $u->save();

        // $faker = FakerFactory::create();

        // for ($i = 0; $i < 200; $i++) {
        //   $u = new Usuario();
        //   $u->run = $i%2==0 ? 10000000 + $i : null;
        //   $u->nombre = $faker->firstName;
        //   $u->apellido_paterno = $faker->lastName;
        //   $u->apellido_materno = $faker->lastName;
        //   $u->correo = $faker->unique()->safeEmail;
        //   $u->password = hash('sha256', '123456');
        //   $u->id_sede = 1300;
        //   $u->tipo_usuario = 2;
        //   $u->save();
        // }
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

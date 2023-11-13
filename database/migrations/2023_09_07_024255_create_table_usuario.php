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
            $table->integer('tipo_usuario')->nullable();
            $table->json('info')->nullable();
            $table->json('integrations')->nullable();
            $table->foreignId('id_sede')->references('id')->on('sede');
            $table->boolean('user_app')->default(false);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });


        $u = new Usuario();
        $u->nombre = 'admin';
        $u->apellido_paterno = 'admin';
        $u->apellido_materno = 'admin';
        $u->correo = 'admin@gmail.com';
        $u->password = hash('sha256', '123456');
        $u->id_sede = 1300;
        $u->tipo_usuario = 1;
        $u->save();

        $faker = FakerFactory::create();

        for ($i = 0; $i < 200; $i++) {
          $u = new Usuario();
          $u->run = $i%2==0 ? 10000000 + $i : null;
          $u->nombre = $faker->firstName;
          $u->apellido_paterno = $faker->lastName;
          $u->apellido_materno = $faker->lastName;
          $u->correo = $faker->unique()->safeEmail;
          $u->password = hash('sha256', '123456');
          $u->id_sede = 1300;
          $u->tipo_usuario = 2;
          $u->save();
        }
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

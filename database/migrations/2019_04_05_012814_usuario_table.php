<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table){
            $table->increments('id');
            $table->string('nombres',100);
            $table->string('apellidos',100);
            $table->string('cedula',10)->unique();
            $table->string('direccion',100);
            $table->string('telefono',10);

            $table->integer('idtipoUsuario')->unsigned()->index();
            $table->foreign('idtipoUsuario')->references('id')->on('tipousuario');
        });

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
}

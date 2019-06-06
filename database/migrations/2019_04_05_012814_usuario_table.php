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
            $table->bigIncrements('id');
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->string('cedula',10)->unique();
            $table->string('usuario',100);
            $table->string('password',100);
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

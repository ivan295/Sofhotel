<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlquilerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('alquiler', function (Blueprint $table){
            $table->increments('id');
            $table->datetime('fecha');
            $table->time('hora_ingreso_habitacion');
            $table->time('hora_salida_habitacion');
            $table->time('tiempo_alquiler');
            $table->integer('numero de personas');

            $table->integer('id_usuario')->unsigned()->index();
            $table->foreign('id_usuario')->references('id')->on('usuario');

            $table->integer('id_habitacion')->unsigned()->index();
            $table->foreign('id_habitacion')->references('id')->on('habitacion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                Schema::dropIfExists('alquiler');

    }
}

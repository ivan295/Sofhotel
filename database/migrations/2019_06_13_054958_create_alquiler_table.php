<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlquilerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alquiler', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->datetime('fecha')->nullable();
            $table->time('hora_ingreso_habitacion')->nullable();
            $table->time('hora_salida_habitacion')->nullable();
            $table->time('tiempo_alquiler')->nullable();
            $table->integer('numero_personas')->nullable();
            $table->boolean('estado')->nullable();
            $table->integer('auxiliar')->nullable();
            $table->integer('auxiliar2')->nullable();


            $table->bigInteger('id_usuario')->unsigned()->index();
            $table->foreign('id_usuario')->references('id')->on('users');

            $table->bigInteger('id_habitacion')->unsigned()->index();
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

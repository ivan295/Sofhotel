<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HabitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacion', function (Blueprint $table){
            $table->increments('id');
            $table->integer('numero_habitacion');
            $table->string('tipo_habitacion', 100);
            $table->float('precio');
            $table->time('tiempo_limpieza');
            $table->string('ip_arduino',50);

            $table->integer('id_estado')->unsigned()->index();
            $table->foreign('id_estado')->references('id')->on('estado_habitacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habitacion');
    }
}

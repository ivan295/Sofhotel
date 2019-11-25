<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('numero_habitacion');
            $table->string('tipo_habitacion', 100);
            $table->float('precio');
            $table->time('tiempo_limpieza');
            $table->boolean('estado');
            $table->boolean('indice');
            $table->float('iva');
            $table->float('desgloce');
            $table->bigInteger('id_estado')->unsigned()->index();
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

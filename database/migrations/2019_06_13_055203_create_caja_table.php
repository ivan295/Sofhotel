<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('numero_caja');
            $table->bigInteger('id_dinero_final')->unsigned()->nullable();
            $table->bigInteger('id_usuario')->unsigned();
            $table->integer('estado')->nullable();
            $table->decimal('dinero_inicial');
            $table->foreign('id_dinero_final')->references('id')->on('dineros');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cajas');
    }
}

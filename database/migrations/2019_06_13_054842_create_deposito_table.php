<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depositos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('motivo');
            $table->decimal('monto');
            $table->bigInteger('id_usuario')->unsigned();
            $table->bigInteger('id_cuenta')->unsigned();
            $table->boolean('estado');

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_cuenta')->references('id')->on('cuentas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depositos');
    }
}

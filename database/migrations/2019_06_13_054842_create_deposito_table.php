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
        Schema::create('deposito', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('descripcion',100);
            $table->float('total_deposito');
            $table->datetime('fecha_deposito');

            $table->bigInteger('id_Usuario')->unsigned()->index();
            $table->foreign('id_Usuario')->references('id')->on('users');

            $table->bigInteger('id_Cuenta')->unsigned()->index();
            $table->foreign('id_Cuenta')->references('id')->on('cuenta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposito');
    }
}

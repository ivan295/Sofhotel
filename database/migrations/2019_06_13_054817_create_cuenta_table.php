<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
              $table->string('numero_cuenta');
            $table->bigInteger('id_tipo_cuenta')->unsigned();
            $table->bigInteger('id_propietario')->unsigned();
            $table->bigInteger('id_banco')->unsigned();

            $table->foreign('id_tipo_cuenta')->references('id')->on('tipo_cuentas');
            $table->foreign('id_propietario')->references('id')->on('propietario_cuentas');
            $table->foreign('id_banco')->references('id')->on('bancos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas');
    }
}

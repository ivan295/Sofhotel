<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FacturaCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_compra', function (Blueprint $table){
            $table->increments('id');
            $table->string('descripcion',100);
            $table->float('total_pagar');
            $table->datetime('fecha_compra');
            $table->time('hora_compra');

            $table->integer('id_proveedor')->unsigned()->index();
            $table->foreign('id_proveedor')->references('id')->on('proveedor');

            $table->bigInteger('id_usuario')->unsigned()->index();
            $table->foreign('id_usuario')->references('id')->on('usuario');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_compra');
    }
}

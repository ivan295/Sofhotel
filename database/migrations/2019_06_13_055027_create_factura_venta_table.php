<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_venta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->float('total_alquiler');
            $table->float('total_productos');
            $table->float('total_cobro');

            $table->bigInteger('id_alquiler')->unsigned()->index();
            $table->foreign('id_alquiler')->references('id')->on('alquiler');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_venta');
    }
}

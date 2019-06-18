<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('cantidad');
            $table->float('total_venta');
            
            $table->bigInteger('id_factura_venta')->unsigned()->index();
            $table->foreign('id_factura_venta')->references('id')->on('factura_venta');

            $table->bigInteger('id_producto')->unsigned()->index();
            $table->foreign('id_producto')->references('id')->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_venta');
    }
}

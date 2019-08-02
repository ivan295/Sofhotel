<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_compra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('cantidad');
            $table->float('subtotal');
            $table->float('precio_compra');
            $table->float('total');
            
            $table->bigInteger('id_factura')->unsigned()->index();
            $table->foreign('id_factura')->references('id')->on('factura_compra');

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
        Schema::dropIfExists('detalle_compra');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('descripcion',100);
            $table->float('precio_venta');
            $table->integer('stock');
            $table->float('precio_compra');

            $table->bigInteger('id_proveedor')->unsigned()->index();
            $table->foreign('id_proveedor')->references('id')->on('proveedor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}

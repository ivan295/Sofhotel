<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_compra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
             $table->string('descripcion',100);
            $table->float('total_pagar');
            $table->boolean('estado');

            $table->bigInteger('id_proveedor')->unsigned()->index();
            $table->foreign('id_proveedor')->references('id')->on('proveedor');

            $table->bigInteger('id_usuario')->unsigned()->index();
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
        Schema::dropIfExists('factura_compra');
    }
}

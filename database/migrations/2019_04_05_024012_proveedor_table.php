<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table){
            $table->increments('id');

            $table->string('nombres',100);
            $table->string('apellidos',100);
            $table->string('cedula',10)->unique();
            $table->string('telefono',10);
            $table->string('correo',20);
            $table->string('empresa',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor');
    }
}

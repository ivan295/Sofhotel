<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CuentaTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta', function (Blueprint $table){
            $table->increments('id');
            $table->string('numero_cuenta',10);
                        
            $table->integer('id_propietario')->unsigned()->index();
            $table->foreign('id_propietario')->references('id')->on('propietario_cuenta');

            $table->integer('id_banco')->unsigned()->index();
            $table->foreign('id_banco')->references('id')->on('banco');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuenta');
    }
}

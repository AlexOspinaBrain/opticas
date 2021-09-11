<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetfacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detfacturas', function (Blueprint $table) {
            $table->bigIncrements('id');           
            
            $table->bigInteger('facturasid_id')->unsigned();
            $table->foreign('facturasid_id')->references('id')->on('facturas');

            $table->bigInteger('clientesid_id')->nullable()->unsigned();
            $table->foreign('clientesid_id')->references('id')->on('clientes');

            $table->bigInteger('productosid_id')->unsigned();
            $table->foreign('productosid_id')->references('id')->on('productos');

            $table->integer('valoritem')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->integer('valortotitem')->unsigned();

            $table->boolean('consulta')->nullable()->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detfacturas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('clienteid_id')->unsigned();
            $table->foreign('clienteid_id')->references('id')->on('clientes');

            $table->bigInteger('cliente_factura_id')->unsigned();
            $table->foreign('cliente_factura_id')->references('id')->on('clientes');

            $table->bigInteger('facturasid_id')->unsigned();
            $table->foreign('facturasid_id')->references('id')->on('facturas');


            $table->bigInteger('cie10id_id')->nullable()->unsigned();
            $table->foreign('cie10id_id')->references('id')->on('cie10');

            $table->bigInteger('cie10id_id2')->nullable()->unsigned();
            $table->foreign('cie10id_id2')->references('id')->on('cie10');

            $table->bigInteger('usersid_id')->unsigned();
            $table->foreign('usersid_id')->references('id')->on('users');


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
        Schema::dropIfExists('historias');
    }
}

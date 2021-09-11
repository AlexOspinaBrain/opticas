<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('clienteid_id')->unsigned();
            $table->foreign('clienteid_id')->references('id')->on('clientes');
            
            $table->string('consecutivoalt', 7)->nullable();
            
            $table->boolean('confirmada')->nullable()->default(false);
            
            $table->integer('subtotal')->unsigned()->default(0);
            $table->integer('iva')->unsigned()->default(0);
            $table->integer('total')->unsigned()->default(0);

            $table->integer('abono')->unsigned()->default(0);

            $table->boolean('cancelada')->nullable()->default(false);
            
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
        Schema::dropIfExists('facturas');
    }
}

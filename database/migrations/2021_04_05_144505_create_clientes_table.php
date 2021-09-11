<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tiposid_id')->unsigned();
            $table->foreign('tiposid_id')->references('id')->on('tiposid');
            $table->string('cedula',16);
            $table->string('prinom');
            $table->string('segnom')->nullable();
            $table->string('priape');
            $table->string('segape')->nullable();;
            $table->string('ocupacion')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('eps_id')->unsigned()->nullable();
            $table->foreign('eps_id')->references('id')->on('eps');
            $table->bigInteger('municipio_id')->unsigned()->nullable();
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->bigInteger('pais_id')->unsigned()->nullable();
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->string('celular')->nullable();
            $table->string('direccion')->nullable();
            $table->timestamp('nacimiento')->nullable();
            $table->bigInteger('estadocivil_id')->unsigned()->nullable();
            $table->foreign('estadocivil_id')->references('id')->on('estadocivil');
            $table->string('hijos',2)->nullable();
            $table->string('genero',2);            
            $table->bigInteger('idusersid_id')->unsigned();
            $table->foreign('idusersid_id')->references('id')->on('users');
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
        Schema::dropIfExists('clientes');
    }
}

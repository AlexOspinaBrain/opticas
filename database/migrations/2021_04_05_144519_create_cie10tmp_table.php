<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCie10tmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cie10tmp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo', 4);
            $table->string('nombre');
            $table->string('sexo',1);
            $table->integer('edadminima');
            $table->integer('edadmaxima');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cie10tmp');
    }
}

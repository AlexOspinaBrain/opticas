<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCie10Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cie10', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo', 4);
            $table->string('nombre');
            $table->string('sexo',1);
            $table->integer('edadminima');
            $table->integer('edadmaxima');
            $table->boolean('mortal')->default(false);
            $table->boolean('morbilidad')->default(false);
            $table->string('clase',3)->nullable();
            $table->text('anos')->nullable();
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
        Schema::dropIfExists('cie10');
    }
}

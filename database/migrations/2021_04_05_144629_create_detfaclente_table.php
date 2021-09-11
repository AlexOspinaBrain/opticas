<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetfaclenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detfaclente', function (Blueprint $table) {
            $table->bigIncrements('id');            
            
            $table->bigInteger('detfacturasid_id')->unsigned();
            $table->foreign('detfacturasid_id')->references('id')->on('detfacturas');

            $table->string('lesferaoi')->nullable();
            $table->string('lesferaod')->nullable();
            $table->string('lcilindroi')->nullable();
            $table->string('lcilindrod')->nullable();
            $table->string('lejei')->nullable();
            $table->string('lejed')->nullable();
            $table->string('laddi')->nullable();
            $table->string('laddd')->nullable();
            $table->string('ldpi')->nullable();
            $table->string('ldpd')->nullable();

            $table->string('cesferaoi')->nullable();
            $table->string('cesferaod')->nullable();
            $table->string('ccilindroi')->nullable();
            $table->string('ccilindrod')->nullable();
            $table->string('cejei')->nullable();
            $table->string('cejed')->nullable();
            $table->string('caddi')->nullable();
            $table->string('caddd')->nullable();
            $table->string('cdpi')->nullable();
            $table->string('cdpd')->nullable();
            
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
        Schema::dropIfExists('detfaclente');
    }
}

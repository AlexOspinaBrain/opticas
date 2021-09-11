<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            
            $table->boolean('lente')->after('nombre')->default(false);
            
            $table->boolean('activo')->after('lente')->default(true);

            $table->bigInteger('usersid_id')->after('valor')->unsigned()->default(1);
            $table->foreign('usersid_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('lente');
            $table->dropColumn('activo');
            $table->dropColumn('usersid_id');
        });
    }
}

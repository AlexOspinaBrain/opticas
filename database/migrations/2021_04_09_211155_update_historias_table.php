<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historias', function (Blueprint $table) {
            
            $table->text('anamnesis');
            
            $table->string('avscvlod')->nullable();
            $table->string('avscvloi')->nullable();
            $table->string('vpod')->nullable();
            $table->string('vpoi')->nullable();
            $table->string('ao')->nullable();
            $table->string('exmextod')->nullable();
            $table->string('exmextoi')->nullable();
            $table->string('convinf')->nullable();
            $table->string('convdp')->nullable();
            $table->string('cms')->nullable();
            $table->string('ppc')->nullable();
            $table->string('tcolod')->nullable();
            $table->string('tcoli')->nullable();
            $table->string('smod')->nullable();
            $table->string('smoi')->nullable();
            $table->string('test')->nullable();
            $table->string('pris')->nullable();

            $table->string('ofod')->nullable();
            $table->string('ofoi')->nullable();
            $table->string('qod')->nullable();
            $table->string('qoi')->nullable();
            $table->string('tonod')->nullable();
            $table->string('tonoi')->nullable();
            $table->string('refdimod')->nullable();
            $table->string('refdimoi')->nullable();
            $table->string('refesod')->nullable();
            $table->string('refesoi')->nullable();
            $table->string('subod')->nullable();
            $table->string('suboi')->nullable();
            
            $table->string('rxod')->nullable();
            $table->string('rxoi')->nullable();
            $table->string('add')->nullable();
            $table->text('conducta')->nullable();

            $table->string('esfod')->nullable();
            $table->string('esfoi')->nullable();
            $table->string('cilod')->nullable();
            $table->string('ciloi')->nullable();
            $table->string('ejeod')->nullable();
            $table->string('ejeoi')->nullable();
            $table->string('addod')->nullable();
            $table->string('addoi')->nullable();
            $table->string('avod')->nullable();
            $table->string('avoi')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historias', function (Blueprint $table) {
            $table->dropColumn(['anamnesis','avscvlod','avscvloi','vpod','vpoi','ao','exmextod','exmextoi','convinf',
                'convdp','cms','ppc','tcolod','tcoli','smod','smoi','test','pris','ofod','ofoi','qod','qoi','tonod','tonoi',
                'refdimod','refdimoi','refesod','refesoi','subod','suboi','rxod','rxoi','add','conducta','esfod','esfoi',
                'cilod','ciloi','ejeod','ejeoi','addod','addoi','avod','avoi']);
        });
    }
}

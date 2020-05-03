<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCargaAcademicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_carga_academicas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_carga_academica')->unsigned();
            $table->foreign('id_carga_academica')->references('id')->on('carga_academicas');
            $table->string('clase');
            $table->string('hora');
            $table->string('aula');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('dia');
            $table->string('observaciones');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_carga_academicas');
    }
}

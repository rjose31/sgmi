<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleFlujogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_flujogramas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_flujograma')->unsigned();
            $table->foreign('id_flujograma')->references('id')->on('flujogramas');
            $table->string('codigo_clase');
            $table->string('nombre_clase');
            $table->string('estado');
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
        Schema::dropIfExists('detalle_flujogramas');
    }
}

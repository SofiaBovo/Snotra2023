<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriteriosevaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criteriosevaluacion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('criterio');
            $table->bigInteger('id_espacio')->unsigned();
            $table->foreign('id_espacio')->references('id')->on('espacioscurriculares');
            $table->bigInteger('id_año')->unsigned();
            $table->foreign('id_año')->references('id')->on('año');
            $table->bigInteger('id_grado')->unsigned();
            $table->foreign('id_grado')->references('id')->on('grado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criteriosevaluacion');
    }
}

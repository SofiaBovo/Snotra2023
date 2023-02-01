<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->increments('id');
            $table->integer('dnialumno');
            $table->string('nombrealumno');
            $table->string('apellidoalumno');
            $table->date('fechanacimiento');
            $table->string('generoalumno');
            $table->string('domicilio');
            $table->string('localidad');
            $table->string('provincia');
            $table->timestamps();
            $table->bigInteger('familias_id')->unsigned();
            $table->foreign('familias_id')->references('id')->on('familias');
            $table->bigInteger('colegio_id')->unsigned();
            $table->foreign('colegio_id')->references('id')->on('colegio');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}

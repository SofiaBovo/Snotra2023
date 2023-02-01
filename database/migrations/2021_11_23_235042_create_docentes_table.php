<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->increments('id');
            $table->integer('dni');
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fechanacimiento');
            $table->string('genero');
            $table->string('domicilio');
            $table->string('localidad');
            $table->string('provincia');
            $table->string('estadocivil');
            $table->integer('telefono');
            $table->string('email')->unique();;
            $table->integer('legajo');
            $table->string('especialidad');
            $table->timestamps();
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
        Schema::dropIfExists('docentes');
    }
}

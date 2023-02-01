<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grado', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('descripcion');
            $table->bigInteger('id_año')->unsigned();
            $table->foreign('id_año')->references('id')->on('año');
            $table->bigInteger('id_docentes')->unsigned();
            $table->foreign('id_docentes')->references('id')->on('docentes');
            $table->bigInteger('id_alumnos')->unsigned();
            $table->foreign('id_alumnos')->references('id')->on('alumnos');
            $table->bigInteger('id_docentesespe')->unsigned();
            $table->foreign('id_docentesespe')->references('id')->on('docentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grado');
    }
}

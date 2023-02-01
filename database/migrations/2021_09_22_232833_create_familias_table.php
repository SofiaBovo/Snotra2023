<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familias', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->id();
            $table->timestamps();
            $table->string('nombrefamilia');
            $table->string('apellidofamilia');
            $table->integer('dnifamilia');
            $table->string('generofamilia');
            $table->integer('telefono');
            $table->string('email')->unique();
            $table->string('vinculofamiliar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('familias');
    }
}
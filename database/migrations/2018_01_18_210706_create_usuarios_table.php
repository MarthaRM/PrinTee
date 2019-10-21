<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('ap');
            $table->string('am');
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->integer('id_tipo')->unsigned();
            $table->foreign('id_tipo')->references('id')->on('tipos_de_usuario');
            $table->string('direccion');
            $table->bigInteger('telefono');
            $table->rememberToken();
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
        Schema::dropIfExists('usuarios');
    }
}

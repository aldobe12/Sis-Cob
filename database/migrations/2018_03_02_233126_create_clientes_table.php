<?php

use App\Cliente;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('avatar')->default('default-avatar.png');
            $table->string('sexo')->default(Cliente::masculino);
            $table->string('cedula');
            $table->string('fechaN');
            $table->string('celular');
            $table->string('tel');
            $table->string('vivienda');
            $table->string('direccion');
            $table->string('civil');
            $table->string('empleo');
            $table->string('ingreso');
            $table->string('referenciaPersonal');
            $table->string('telR'); 
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}

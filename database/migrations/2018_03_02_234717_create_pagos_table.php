<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prestamo_id')->unisgned();
            $table->integer('cuota')->unisgned();
            $table->string('fecha_pago');
            $table->integer('capital')->unisgned();
            $table->integer('interes')->unisgned();
            $table->integer('mora')->unisgned();
            $table->string('forma_pago');
            $table->string('nota');
            $table->string('estado')->default('activo');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('prestamo_id')->references('id')->on('prestamos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}

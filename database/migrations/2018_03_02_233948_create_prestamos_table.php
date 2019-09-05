<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->string('amortizacion');
            $table->integer('monto')->unsigned();
            $table->integer('monto_actual')->unsigned();
            $table->float('interes', 2,1)->unsigned();
            $table->integer('cuotas')->unsigned();
            $table->string('metodo_pago');
            $table->string('fecha');
            $table->string('codeudor');
            $table->string('cDireccion');
            $table->string('cTelefono');
            $table->string('estado')->default('activo');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}

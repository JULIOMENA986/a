<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrasladoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traslados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('refaccion_fk');
            $table->foreign('refaccion_fk')->references('id')->on('refacciones');
            $table->unsignedBigInteger('inicio');
            $table->foreign('inicio')->references('id')->on('tallers');
            $table->unsignedBigInteger('destino');
            $table->foreign('destino')->references('id')->on('tallers');
            $table->date('fecha_entrega');
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
        Schema::dropIfExists('traslados');
    }
}

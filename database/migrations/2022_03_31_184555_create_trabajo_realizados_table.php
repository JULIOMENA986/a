<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajoRealizadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajo__realizados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->unsignedBigInteger('carro');
            $table->foreign('carro')->references('id')->on('autos');
            $table->unsignedBigInteger('dueño');
            $table->foreign('dueño')->references('id')->on('clientes');
            $table->unsignedBigInteger('mecanico');
            $table->foreign('mecanico')->references('id')->on('mecanicos');
            $table->date('fecha_termino');
            $table->unsignedBigInteger('mano_obra');
            $table->foreign('mano_obra')->references('id')->on('tipo__trabajos');
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
        Schema::dropIfExists('trabajo__realizados');
    }
}

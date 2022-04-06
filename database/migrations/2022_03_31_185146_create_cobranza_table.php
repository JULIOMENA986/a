<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobranzaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobranzas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trabajo_realizado_fk');
            $table->foreign('trabajo_realizado_fk')->references('id')->on('trabajo__realizados');
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
        Schema::dropIfExists('cobranzas');
    }
}

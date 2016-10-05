<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformarEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informar_estoques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produto_id')->nullable();
            $table->integer('granel_id')->nullable();
            $table->integer('quantidade');
            $table->text('justificativa');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('granel_id')->references('id')->on('granels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('informar_estoques');
    }
}

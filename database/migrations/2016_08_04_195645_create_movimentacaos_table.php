<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimentacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venda_id')->nullable();
            $table->integer('quantidade');
            $table->integer('produto_id');
            $table->string('razao');
            $table->integer('usuario_id');

            $table->foreign('venda_id')->references('id')->on('vendas');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('usuario_id')->references('id')->on('users');

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
        Schema::drop('movimentacaos');
    }
}

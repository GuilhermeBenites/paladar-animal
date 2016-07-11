<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableItemVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_vendas', function (Blueprint $table) {
            $table->foreign('venda_id')->references('id')->on('vendas');

            $table->float('precoUnidade');
            $table->float('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_vendas', function (Blueprint $table) {
            //
        });
    }
}

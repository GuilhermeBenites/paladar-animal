<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableItemVenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_venda', function (Blueprint $table) {

            $table->integer('granel_id')->nullable();

            $table->foreign('granel_id')->references('id')->on('granels');

            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_venda', function (Blueprint $table) {
            //
        });
    }
}

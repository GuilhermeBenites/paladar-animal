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

            $table->integer('produto_id')->nullable();

            $table->integer('granel_id')->nullable();
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
            $table->dropColumn('granel_id');
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableGranelEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('granel_estoques', function (Blueprint $table) {
            $table->dropColumn('produto_id');
            $table->integer('granel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('granel_estoques', function (Blueprint $table) {
            $table->dropColumn('granel_id');
            $table->integer('produto_id');
        });
    }
}

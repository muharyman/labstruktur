<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyItemPengujian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_pengujian', function (Blueprint $table) {
            $table->foreign('idpengujian')->references('idpengujian')->on('pengujian')
            ->onDelete('no action')
            ->onDelete('no action');

            $table->foreign('idjenis_pengujian')->references('idjenis_pengujian')->on('jenis_pengujian')
            ->onDelete('no action')
            ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_pengujian', function (Blueprint $table) {
            $table->dropForeign(['idpengujian']);
            $table->dropForeign(['idjenis_pengujian']);
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyFotoInventaris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foto_inventaris', function (Blueprint $table) {
            $table->foreign('idinventaris')->references('idinventaris')->on('inventaris')
            ->onDelete('no action')
            ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foto_inventaris', function (Blueprint $table) {
            $table->dropForeign(['idinventaris']);
        });
    }
}

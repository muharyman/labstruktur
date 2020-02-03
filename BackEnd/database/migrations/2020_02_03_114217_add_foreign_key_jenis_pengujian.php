<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyJenisPengujian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_pengujian', function (Blueprint $table) {
            $table->foreign('idkategori_pengujian')->references('idkategori_pengujian')->on('kategori_pengujian')
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
        Schema::table('jenis_pengujian', function (Blueprint $table) {
            $table->dropForeign(['idkategori_pengujian']);
        });
    }
}

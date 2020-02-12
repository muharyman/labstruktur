<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPengujianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pengujian', function (Blueprint $table) {
            $table->bigIncrements('iditem_pengujian');
            $table->bigInteger('idpengujian')->unsigned();
            $table->bigInteger('idjenis_pengujian')->unsigned()->nullable();
            $table->bigInteger('jumlah_item')->unsigned()->nullable();
            $table->double('biaya_per_pengujian')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('item_pengujian');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengujianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengujian', function (Blueprint $table) {
            $table->bigIncrements('idpengujian');
            $table->string('email')->nullable();
            $table->boolean('status_pembayaran')->nullable();
            $table->date('tanggal_buka')->nullable();
            $table->date('tanggal_pengujian')->nullable();
            $table->date('tanggal_tutup')->nullable();
            $table->bigInteger('iduser_pembuka')->nullable()->unsigned();
            $table->bigInteger('idteknisi')->nullable()->unsigned();
            $table->bigInteger('idengineer')->nullable()->unsigned();
            $table->bigInteger('iduser_penutup')->nullable()->unsigned()->nullable();
            $table->string('pemberi_tugas', 100)->nullable();
            $table->string('npwp', 20)->nullable();
            $table->string('proyek', 100)->nullable();
            $table->date('tanggal_terima')->nullable();
            $table->boolean('status_pengujian')->nullable();
            $table->string('nomor_laporan', 100)->nullable();
            $table->string('nama_laporan', 100)->nullable();
            $table->boolean('status_pengambilan')->nullable();
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
        Schema::dropIfExists('pengujian');
    }
}

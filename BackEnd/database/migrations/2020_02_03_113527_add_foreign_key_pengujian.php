<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyPengujian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengujian', function (Blueprint $table) {
            $table->foreign('iduser_pembuka')->references('iduser')->on('users')
            ->onDelete('no action')
            ->onUpdate('no action');

            $table->foreign('idteknisi')->references('iduser')->on('users')
            ->onDelete('no action')
            ->onUpdate('no action');
            
            $table->foreign('idengineer')->references('iduser')->on('users')
            ->onDelete('no action')
            ->onUpdate('no action');

            $table->foreign('iduser_penutup')->references('iduser')->on('users')
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
        Schema::table('pengujian', function (Blueprint $table) {
            $table->dropForeign(['iduser_pembuka']);
            $table->dropForeign(['idteknisi']);
            $table->dropForeign(['idengineer']);
            $table->dropForeign(['iduser_penutup']);
        });
    }
}

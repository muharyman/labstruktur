<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('iduser');
            $table->bigInteger('idjabatan')->unsigned();
            $table->string('nama_login', 50)->unique();
            $table->string('nama_user', 50)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->dateTime('user_created')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->ipAddress('last_ip_login')->nullable();
            $table->date('last_change_password')->nullable();
            $table->boolean('status_user')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

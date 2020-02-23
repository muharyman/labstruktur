<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CreateAdminAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            'iduser' => 1,
            'nama_login' => 'admin',
            'nama_user' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'idjabatan' => 1,
            'user_created' => Carbon::now(),
            'status_user' => true,
            'verification_token' => str_random(60),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->whereIn('iduser', [1])->delete();
    }
}

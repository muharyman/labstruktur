<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('jabatan')->insert([
            ['idjabatan' => 1, 'jabatan' => 'Kepala Lab'],
            ['idjabatan' => 2, 'jabatan' => 'Sekretaris'],
            ['idjabatan' => 3, 'jabatan' => 'Engineer'],
            ['idjabatan' => 4, 'jabatan' => 'Teknisi'],
            ['idjabatan' => 5, 'jabatan' => 'Viewer']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('jabatan')->whereIn('idjabatan', [1,2,3,4,5])->delete();
    }
}

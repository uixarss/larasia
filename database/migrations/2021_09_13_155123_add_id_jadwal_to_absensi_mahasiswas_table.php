<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdJadwalToAbsensiMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absensi_mahasiswas', function (Blueprint $table) {
            // $table->unsignedBigInteger('id_jadwal')->nullable()->after('id_semester');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absensi_mahasiswas', function (Blueprint $table) {
            //
        });
    }
}

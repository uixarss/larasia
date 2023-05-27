<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiRaporTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_rapor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tahun_ajaran');
            $table->string('semester');
            $table->string('wali_kelas');
            $table->string('nis');
            $table->string('nama_siswa');
            $table->string('kelas_siswa');
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
        Schema::dropIfExists('nilai_rapor');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lcobucci\JWT\FunctionalTests\UnsignedTokenTest;

class CreateJadwalPenggantisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_penggantis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tahun_ajaran_id')->nullable();
            $table->unsignedBigInteger('semester_id')->nullable();
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('id_dosen')->nullable();
            $table->unsignedBigInteger('hari_id')->nullable();
            $table->unsignedBigInteger('waktu_id')->nullable();
            $table->unsignedBigInteger('ruangan_id')->nullable();
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->date('tanggal_pengganti')->nullable();
            $table->integer('pertemuan_ke')->nullable();
            $table->string('status')->default('pending'); //0:tidak disetujui, 1:disetujui, 2:pending
            $table->string('keterangan')->nullable();
            $table->string('disetujui_oleh')->nullable();

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
        Schema::dropIfExists('jadwal_penggantis');
    }
}

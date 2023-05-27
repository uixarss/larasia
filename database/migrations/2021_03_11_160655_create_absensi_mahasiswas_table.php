<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_mahasiswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_dosen');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->integer('tingkat_semester');
            $table->unsignedBigInteger('mapel_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('hari_id');
            $table->unsignedBigInteger('waktu_id');
            $table->unsignedBigInteger('id_jadwal');
            $table->integer('pertemuan_ke');
            $table->date('tanggal_masuk')->nullable();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->string('status')->nullable();
            $table->string('keterangan')->nullable();
            $table->decimal('long', 11, 7)->nullable();
            $table->decimal('lat', 11, 7)->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
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
        Schema::dropIfExists('absensi_mahasiswas');
    }
}

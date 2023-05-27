<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('photo')->nullable();
            $table->integer('matkul_id')->nullable();
            $table->string('nama_dosen');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir',10)->nullable();
            $table->enum('jenis_kelamin',['L','P'])->nullable();
            $table->integer('id_agama')->nullable();
            $table->string('nama_agama')->nullable();
            $table->integer('id_status_aktif');
            $table->string('nama_status_aktif');
            $table->string('nidn')->unique()->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nik')->nullable();
            $table->string('nip')->unique()->nullable();
            $table->string('npwp')->nullable();
            $table->integer('id_jenis_sdm')->nullable();
            $table->string('nama_jenis_sdm')->nullable();
            $table->string('no_sk_cpns')->nullable();
            $table->date('tanggal_sk_cpns',10)->nullable();
            $table->string('no_sk_pengangkatan')->nullable();
            $table->date('mulai_sk_pengangkatan',10)->nullable();
            $table->integer('id_lembaga_pengangkatan')->nullable();
            $table->string('nama_lembaga_pengangkatan')->nullable();
            $table->integer('id_pangkat_golongan')->nullable();
            $table->string('nama_pangkat_golongan')->nullable();
            $table->integer('id_sumber_gaji')->nullable();
            $table->string('nama_sumber_gaji')->nullable();
            $table->string('jalan')->nullable();
            $table->string('dusun')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('ds_kel')->nullable();
            $table->integer('kode_pos')->nullable();
            $table->integer('id_wilayah')->nullable();
            $table->string('nama_wilayah')->nullable();
            $table->integer('id_kecamatan')->nullable();
            $table->string('nama_kecamatan')->nullable();
            $table->string('telepon')->nullable();
            $table->string('handphone')->nullable();
            $table->string('email')->unique();
            $table->integer('status_pernikahan')->nullable();
            $table->string('nama_suami_istri')->nullable();
            $table->string('nip_suami_istri')->nullable();
            $table->date('tanggal_mulai_pns',10)->nullable();
            $table->integer('id_pekerjaan_suami_istri')->nullable();
            $table->string('nama_pekerjaan_suami_istri')->nullable();
            $table->string('mampu_handle_kebutuhan_khusus')->nullable();
            $table->string('mampu_handle_braille')->nullable();
            $table->string('mampu_handle_bahasa_isyarat')->nullable();

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
        Schema::dropIfExists('dosen');
    }
}

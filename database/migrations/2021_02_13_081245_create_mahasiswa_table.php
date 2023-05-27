<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nim')->unique();
            $table->integer('user_id');
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('id_prodi')->nullable();
            $table->unsignedBigInteger('id_dosen')->nullable();
            $table->integer('angkatan')->nullable();
            $table->string('tahun_lulus_sma')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->integer('kelas_id')->nullable();
            $table->string('nama_mahasiswa');
            $table->enum('jenis_kelamin',['L','P'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir',10)->nullable();
            $table->integer('id_agama')->nullable();
            $table->string('nama_agama')->nullable();
            $table->string('nik')->nullable();
            $table->string('nisn')->nullable();
            $table->string('npwp')->nullable();
            $table->string('id_negara')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('jalan')->nullable();
            $table->string('dusun')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->integer('kode_pos')->nullable();
            $table->integer('id_wilayah')->nullable();
            $table->string('nama_wilayah')->nullable();
            $table->integer('id_kecamatan')->nullable();;
            $table->string('nama_kecamatan')->nullable();
            $table->integer('id_jenis_tinggal')->nullable();
            $table->string('nama_jenis_tinggal')->nullable();
            $table->integer('id_alat_transportasi')->nullable();
            $table->string('nama_alat_transportasi')->nullable();
            $table->string('telepon')->nullable();
            $table->string('handphone')->nullable();
            $table->string('email')->unique();
            $table->enum('penerima_kps',['0','1'])->nullable();
            $table->string('nomor_kps')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->date('tanggal_lahir_ayah',10)->nullable();
            $table->integer('id_pendidikan_ayah')->nullable();
            $table->string('nama_pendidikan_ayah')->nullable();
            $table->integer('id_pekerjaan_ayah')->nullable();
            $table->string('nama_pekerjaan_ayah')->nullable();
            $table->integer('id_penghasilan_ayah')->nullable();
            $table->string('nama_penghasilan_ayah')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->date('tanggal_lahir_ibu',10)->nullable();
            $table->integer('id_pendidikan_ibu')->nullable();
            $table->string('nama_pendidikan_ibu')->nullable();
            $table->integer('id_pekerjaan_ibu')->nullable();
            $table->string('nama_pekerjaan_ibu')->nullable();
            $table->integer('id_penghasilan_ibu')->nullable();
            $table->string('nama_penghasilan_ibu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->date('tanggal_lahir_wali',10)->nullable();
            $table->integer('id_pendidikan_wali')->nullable();
            $table->string('nama_pendidikan_wali')->nullable();
            $table->integer('id_pekerjaan_wali')->nullable();
            $table->string('nama_pekerjaan_wali')->nullable();
            $table->integer('id_penghasilan_wali')->nullable();
            $table->string('nama_penghasilan_wali')->nullable();
            $table->integer('id_kebutuhan_khusus_mahasiswa')->nullable();
            $table->string('nama_kebutuhan_khusus_mahasiswa')->nullable();
            $table->integer('id_kebutuhan_khusus_ayah')->nullable();
            $table->string('nama_kebutuhan_khusus_ayah')->nullable();
            $table->integer('id_kebutuhan_khusus_ibu')->nullable();
            $table->string('nama_kebutuhan_khusus_ibu')->nullable();
            $table->integer('id_status_mahasiswa')->nullable();
            $table->string('nama_status_mahasiswa')->nullable();
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
        Schema::dropIfExists('mahasiswa');
    }
}

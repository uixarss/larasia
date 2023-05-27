<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilPtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_pt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_perguruan_tinggi')->unique();
            $table->integer('kode_perguruan_tinggi');
            $table->string('nama_perguruan_tinggi');
            $table->string('telepon')->nullable();
            $table->string('faximile')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('jalan')->nullable();
            $table->string('dusun')->nullable();
            $table->string('rt_rw')->nullable();
            $table->string('kelurahan');
            $table->integer('kode_pos');
            $table->integer('id_wilayah');
            $table->string('nama_wilayah');
            $table->string('lintang_bujur')->nullable();
            $table->string('bank')->nullable();
            $table->string('unit_cabang')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('mbs');
            $table->string('luas_tanah_milik');
            $table->string('luas_tanah_bukan_milik');
            $table->string('sk_pendirian')->nullable();
            $table->date('tanggal_sk_pendirian',10)->nullable();
            $table->integer('id_status_milik');
            $table->string('nama_status_milik');
            $table->enum('status_perguruan_tinggi',['A','B','C','D'])->nullable();
            $table->string('sk_izin_operasional')->nullable();
            $table->date('tanggal_izin_operasional',10)->nullable();
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
        Schema::dropIfExists('profil_pt');
    }
}

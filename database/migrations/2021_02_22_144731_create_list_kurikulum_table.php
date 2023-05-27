<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListKurikulumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurikulum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kurikulum');
            $table->unsignedBigInteger('id_fakultas');
            $table->unsignedBigInteger('id_jurusan');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->integer('jumlah_sks_lulus')->nullable();
            $table->integer('jumlah_sks_wajib')->nullable();
            $table->integer('jumlah_sks_pilihan')->nullable();
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
        Schema::dropIfExists('kurikulum');
    }
}

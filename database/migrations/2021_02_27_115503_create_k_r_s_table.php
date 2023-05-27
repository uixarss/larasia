<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKRSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_fakultas');
            $table->unsignedBigInteger('id_jurusan');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->integer('tingkat_semester')->nullable();

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
        Schema::dropIfExists('k_r_s');
    }
}

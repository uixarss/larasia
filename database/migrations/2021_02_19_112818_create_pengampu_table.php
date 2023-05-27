<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengampuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengampu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_dosen');
            $table->unsignedBigInteger('mapel_id');
            $table->unsignedBigInteger('id_fakultas');
            $table->unsignedBigInteger('id_jurusan');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->integer('jumlah_tatap_muka')->nullable();
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
        Schema::dropIfExists('pengampu');
    }
}

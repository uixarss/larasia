<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiRaporSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_rapor_siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nilai_rapor_id');
            $table->string('nama_mapel');
            $table->decimal('kkm');
            $table->decimal('nilai_akhir');
            $table->string('huruf_mutu');
            $table->string('keterangan')->nullable();


            $table->foreign('nilai_rapor_id')
            ->references('id')->on('nilai_rapor')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('nilai_rapor_siswa');
    }
}

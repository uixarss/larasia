<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalUjianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_ujian_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('jadwal_ujians_id');
            $table->dateTime('tanggal_ujian');
            $table->string('nama_ruangan');
            $table->unsignedBigInteger('mapel_id');
            $table->unsignedBigInteger('kelas_id');

            $table->foreign('mapel_id')
            ->references('id')->on('mapel')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('kelas_id')
            ->references('id')->on('kelas')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('jadwal_ujians_id')
            ->references('id')->on('jadwal_ujians')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_ujian_details');
    }
}

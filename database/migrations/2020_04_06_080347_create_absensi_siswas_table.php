<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_siswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('siswa_id');
            $table->date('tanggal_absen');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->enum('keterangan',['Alpha', 'Hadir', 'Sakit', 'Izin']);

            $table->foreign('siswa_id')
            ->references('id')->on('siswa')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('absensi_siswas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->unsignedBigInteger('mapel_id');
            $table->string('kode_tugas');
            $table->string('judul_tugas');
            $table->longText('deskripsi_tugas');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_akhir');
            $table->string('nama_file_tugas')->nullable();
            $table->string('lokasi_file_tugas')->nullable();
            $table->unsignedBigInteger('created_by');


            $table->foreign('created_by')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('mapel_id')
            ->references('id')->on('mapel')
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
        Schema::dropIfExists('tugas');
    }
}

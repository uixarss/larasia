<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mapel_id');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->string('kode_soal')->unique();
            $table->longText('judul_kuis');
            $table->integer('durasi')->nullable();
            $table->dateTime('tanggal_mulai')->nullable();
            $table->dateTime('tanggal_akhir')->nullable();
            $table->integer('jumlah_soal')->nullable();
            $table->unsignedBigInteger('jenisujian_id');
            $table->unsignedBigInteger('id_dosen');
            $table->unsignedBigInteger('dibuat_oleh');

            $table->foreign('dibuat_oleh')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('jenisujian_id')
            ->references('id')->on('jenis_ujians')
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
        Schema::dropIfExists('quizzes');
    }
}

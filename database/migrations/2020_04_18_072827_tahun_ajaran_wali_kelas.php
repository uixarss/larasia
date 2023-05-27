<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TahunAjaranWaliKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_ajaran_guru_kelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_ajaran_id');

            $table->foreign('guru_id')
            ->references('id')->on('gurus')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('kelas_id')
            ->references('id')->on('kelas')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('tahun_ajaran_id')
            ->references('id')->on('tahun_ajarans')
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
        //
        Schema::dropIfExists('tahun_ajaran_guru_kelas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiAkhirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_akhir', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('mapel_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->unsignedBigInteger('semester_id');
            $table->decimal('nilai_akhir');


            $table->foreign('siswa_id')
            ->references('id')->on('siswa')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('guru_id')
            ->references('id')->on('gurus')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('mapel_id')
            ->references('id')->on('mapel')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('tahun_ajaran_id')
            ->references('id')->on('tahun_ajarans')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('semester_id')
            ->references('id')->on('semesters')
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
        Schema::dropIfExists('nilai_akhir');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->unsignedBigInteger('id_dosen')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('hari_id')->nullable();
            $table->unsignedBigInteger('waktu_id')->nullable();
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->unsignedBigInteger('tahun_ajaran_id')->nullable();
            $table->unsignedBigInteger('semester_id')->nullable();
            $table->unsignedBigInteger('ruangan_id')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('type')->nullable();
            $table->float('value')->nullable();
            $table->string('value_process')->nullable();
            $table->foreign('mapel_id')
                ->references('id')->on('mapel')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // $table->foreign('guru_id')
            // ->references('id')->on('gurus')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');

            $table->foreign('id_dosen')
            ->references('id')->on('dosen')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->foreign('kelas_id')
                ->references('id')->on('kelas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('hari_id')
                ->references('id')->on('haris')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('waktu_id')
                ->references('id')->on('waktus')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('prodi_id')
            ->references('id_prodi')->on('prodi')
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
        Schema::dropIfExists('jadwals');
    }
}

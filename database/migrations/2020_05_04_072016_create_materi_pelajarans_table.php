<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi_pelajarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->unsignedBigInteger('mapel_id');
            $table->string('bab_materi');
            $table->string('nama_materi');
            $table->longText('deskripsi_materi')->nullable();
            $table->string('file_materi')->nullable();
            $table->integer('jumlah_unduh')->nullable();
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
        Schema::dropIfExists('materi_pelajarans');
    }
}

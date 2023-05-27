<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi_kelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('materi_pelajaran_id');
            $table->unsignedBigInteger('kelas_id');

            $table->foreign('materi_pelajaran_id')
            ->references('id')->on('materi_pelajarans')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('kelas_id')
            ->references('id')->on('kelas')
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
        Schema::dropIfExists('materi_kelas');
    }
}

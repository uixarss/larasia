<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agenda_id');
            $table->date('tanggal_kbm');
            $table->string('jam_kbm');
            $table->string('nama_kelas');
            $table->longText('kegiatan');
            $table->longText('penugasan');

            $table->timestamps();
            $table->softDeletes();


            $table->foreign('agenda_id')
            ->references('id')->on('agendas')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendas_detail');
    }
}

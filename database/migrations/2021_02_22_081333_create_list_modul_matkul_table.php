<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListModulMatkulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modul_matkul', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_jurusan');
            $table->integer('id_prodi');
            $table->integer('id_matkul');
            $table->integer('id_semester');
            $table->integer('id_tahun_ajaran');
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
        Schema::dropIfExists('modul_matkul');
    }
}

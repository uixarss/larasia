<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSkripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('data_skripsi')) {
            Schema::create('data_skripsi', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('judul')->nullable();
                $table->string('tahun_terbit')->nullable();
                $table->string('penulis')->nullable();
                $table->string('NRP')->unique();
                $table->unsignedBigInteger('id_prodi')->nullable();
                $table->string('metode')->nullable();
                $table->string('rak');
                $table->string('baris');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_skripsi');
    }
}

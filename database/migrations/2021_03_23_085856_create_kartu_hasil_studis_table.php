<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuHasilStudisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_hasil_studis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_mahasiswa'); // untuk ambil nim
            $table->integer('tingkat_semester'); // semester 1,2,3,...,8
            $table->unsignedBigInteger('id_prodi'); // filter per prodi
            $table->unsignedBigInteger('id_semester'); // semester ganjil, genap
            $table->unsignedBigInteger('id_tahun_ajaran'); // tahun ajaran 2021/2022
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
        Schema::dropIfExists('kartu_hasil_studis');
    }
}

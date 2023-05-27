<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrsSp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krs_sp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_fakultas');
            $table->unsignedBigInteger('id_jurusan');
            $table->unsignedBigInteger('id_prodi');
            $table->integer('tingkat_semester');
            $table->unsignedBigInteger('mapel_id');
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
        Schema::dropIfExists('krs_sp');
    }
}

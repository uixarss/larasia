<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOptionSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_siswa', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('option_id');

            $table->foreign('option_id')
            ->references('id')->on('options')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('siswa_id')
            ->references('id')->on('siswa')
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
        Schema::dropIfExists('option_siswa');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_kelas')->unique();
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->string('nama_kelas');
            $table->integer('kapasitas')->nullable();
            $table->string('jurusan')->nullable();
            $table->integer('tingkat')->nullable();
            $table->string('kondisi')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('jurusan_id')
            ->references('id')->on('jurusans')
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
        Schema::dropIfExists('kelas');
    }
}

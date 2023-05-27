<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('NIS', 50)->unique();
            $table->string('NISN')->unique()->nullable();
            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->string('tahun_masuk')->nullable();
            $table->string('agama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir',10)->nullable();
            $table->enum('jenis_kelamin',['L','P'])->nullable();
            $table->string('golongan_darah',10)->nullable();
            $table->string('kebangsaan', 50)->nullable();
            $table->string('photo')->nullable();
            $table->string('no_phone')->nullable();
            $table->string('email_siswa')->nullable();
            $table->longText('alamat_sekarang')->nullable();
            $table->enum('status', [0,1])->default(1);


          $table->foreign('user_id')
          ->references('id')->on('users')
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
        Schema::dropIfExists('siswa');
    }
}

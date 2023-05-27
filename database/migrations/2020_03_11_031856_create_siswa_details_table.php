<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->string('anak_ke')->nullable();
            $table->string('jumlah_saudara')->nullable();
            $table->string('kondisi_siswa')->nullable();
            $table->longText('note')->nullable();
            $table->string('asal_sd')->nullable();
            $table->string('asal_smp')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->mediumText('no_hp_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->float('penghasilan_ayah')->nullable();
            $table->longText('alamat_lengkap_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->mediumText('no_hp_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->float('penghasilan_ibu')->nullable();
            $table->longText('alamat_lengkap_ibu')->nullable();

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
        Schema::dropIfExists('siswa_details');
    }
}

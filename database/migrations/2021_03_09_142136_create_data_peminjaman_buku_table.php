<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPeminjamanBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_peminjaman_buku', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('data_buku_id');
            $table->unsignedBigInteger('list_kondisi_id')->nullable();
            $table->integer('jumlah')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->string('penerima')->nullable();
            $table->enum('status', [0,1])->default(1);

            $table->foreign('siswa_id')
            ->references('id')->on('mahasiswa')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('data_buku_id')
            ->references('id')->on('data_buku')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('list_kondisi_id')
            ->references('id')->on('list_kondisi')
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
        Schema::dropIfExists('data_peminjaman_buku');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarUlangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_ulangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->integer('tingkat_semester');
            $table->boolean('konfirmasi')->default(false);
            $table->boolean('status_pembayaran')->default(false);
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
        Schema::dropIfExists('daftar_ulangs');
    }
}

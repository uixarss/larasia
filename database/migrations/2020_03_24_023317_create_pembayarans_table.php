<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->unsignedBigInteger('semester_id');
            $table->integer('tingkat_semester');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_prodi');
            $table->mediumText('nama_tagihan');
            $table->mediumText('catatan')->nullable();
            $table->date('deadline')->nullable();
            $table->decimal('jumlah_tagihan', 10,2 )->nullable();
            $table->enum('status', ['BELUM LUNAS','LUNAS']);
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
        Schema::dropIfExists('pembayarans');
    }
}

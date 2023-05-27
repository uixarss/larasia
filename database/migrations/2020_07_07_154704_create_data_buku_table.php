<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_buku', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kategori_buku_id');
            $table->string('ISBN')->unique();
            $table->string('judul_buku')->nullable();
            $table->string('penulis')->nullable();
            $table->string('penerbit')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->integer('stok_buku')->nullable();

            $table->foreign('kategori_buku_id')
            ->references('id')->on('kategori_buku')
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
        Schema::dropIfExists('data_buku');
    }
}

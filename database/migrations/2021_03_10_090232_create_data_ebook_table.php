<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataEbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_ebook', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kategori_ebook_id');
            $table->string('ISBN')->unique();
            $table->string('judul_ebook')->nullable();
            $table->string('penulis')->nullable();
            $table->string('penerbit')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('file_ebook')->nullable();
            $table->string('status')->nullable();

            $table->foreign('kategori_ebook_id')
            ->references('id')->on('kategori_buku')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('data_ebook');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataDownloadEbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_download_ebook', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_ebook');
            $table->unsignedBigInteger('id_mahasiswa');


            $table->foreign('id_ebook')
            ->references('id')->on('data_ebook')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_mahasiswa')
            ->references('id')->on('mahasiswa')
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
        Schema::dropIfExists('data_download_ebook');
    }
}

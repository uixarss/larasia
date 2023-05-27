<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKondisiBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kondisi_buku', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('data_buku_id');
            $table->unsignedBigInteger('list_kondisi_id');
            $table->integer('jumlah')->nullable();


            $table->foreign('data_buku_id')
            ->references('id')->on('data_buku')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('list_kondisi_id')
            ->references('id')->on('list_kondisi')
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
        Schema::dropIfExists('data_kondisi_buku');
    }
}

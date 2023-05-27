<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBukuDistributorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_buku_distributor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('data_buku_id');
            $table->unsignedBigInteger('distributor_buku_id');
            $table->integer('jumlah_buku')->nullable();
            $table->date('tanggal_masuk')->nullable();

            $table->foreign('data_buku_id')
            ->references('id')->on('data_buku')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('distributor_buku_id')
            ->references('id')->on('distributor_buku')
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
        Schema::dropIfExists('data_buku_distributor');
    }
}

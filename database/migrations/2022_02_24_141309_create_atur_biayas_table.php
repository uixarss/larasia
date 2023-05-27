<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAturBiayasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atur_biayas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_master_biaya');
            $table->unsignedBigInteger('biaya_id');
            $table->double('jumlah')->nullable();
            $table->string('model_pembayaran')->nullable();
            $table->string('tipe_biaya')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('atur_biayas');
    }
}

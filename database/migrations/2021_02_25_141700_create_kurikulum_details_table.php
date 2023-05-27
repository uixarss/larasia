<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKurikulumDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurikulum_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kurikulum_id');
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('mapel_id');
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
        Schema::dropIfExists('kurikulum_details');
    }
}

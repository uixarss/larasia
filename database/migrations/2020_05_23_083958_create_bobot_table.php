<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBobotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobot', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('mapel_id');
          $table->unsignedBigInteger('guru_id');
          $table->unsignedBigInteger('bobot_pengetahuan_id');
          $table->unsignedBigInteger('bobot_keterampilan_id');

          $table->foreign('mapel_id')
          ->references('id')->on('mapel')
          ->onDelete('cascade')
          ->onUpdate('cascade');

          $table->foreign('guru_id')
          ->references('id')->on('gurus')
          ->onDelete('cascade')
          ->onUpdate('cascade');

          $table->foreign('bobot_pengetahuan_id')
          ->references('id')->on('bobot_pengetahuan')
          ->onDelete('cascade')
          ->onUpdate('cascade');

          $table->foreign('bobot_keterampilan_id')
          ->references('id')->on('bobot_keterampilan')
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
        Schema::dropIfExists('bobot');
    }
}

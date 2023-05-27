<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataorangtuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orangtua', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('user_id')->nullable();
          $table->unsignedBigInteger('siswa_id')->nullable();
          $table->string('username')->unique()->nullable();
          $table->string('nama_orangtua');
          $table->string('nama_siswa')->nullable();
          $table->string('email_orangtua')->unique();
          $table->timestamp('email_verified_at')->nullable();
          $table->string('nohp_orangtua')->nullable();
          $table->longText('alamat')->nullable();



          $table->foreign('user_id')
          ->references('id')->on('users')
          ->onDelete('cascade')
          ->onUpdate('cascade');


          $table->foreign('siswa_id')
          ->references('id')->on('siswa')
          ->onDelete('cascade');

          $table->rememberToken();
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
        Schema::dropIfExists('dataorangtua');
    }
}

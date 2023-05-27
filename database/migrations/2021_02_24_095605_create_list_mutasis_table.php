<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListMutasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mutasiable_id');
            $table->string('mutasiable_type');
            $table->integer('id_fakultas');
            $table->integer('id_jurusan');
            $table->integer('id_prodi');
            $table->string('bagian');
            $table->string('jabatan');
            $table->date('tanggal_mutasi',10)->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('mutasis');
    }
}

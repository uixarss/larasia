<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePimpinansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pimpinans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fakultas_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->unsignedBigInteger('prodi_id');
            $table->unsignedBigInteger('dosen_id');
            $table->string('posisi_jabatan');
            $table->string('mulai_menjabat')->nullable();
            $table->string('akhir_menjabat')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('pimpinans');
    }
}

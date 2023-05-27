<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pekerjaanable_id');
            $table->string('pekerjaanable_type');
            $table->year('tahun_awal');
            $table->year('tahun_akhir');
            $table->string('tempat');
            $table->string('jabatan');
            $table->enum('status',['Aktif', 'Non Aktif']);
            $table->string('keterangan');


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
        Schema::dropIfExists('pekerjaans');
    }
}

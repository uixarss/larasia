<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSertifikatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sertifikatable_id');
            $table->string('sertifikatable_type');
            $table->string('sertifikasi');
            $table->string('lembaga');
            $table->year('tahun');
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
        Schema::dropIfExists('sertifikats');
    }
}

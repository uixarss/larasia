<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendidikans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pendidikanable_id');
            $table->string('pendidikanable_type');
            $table->string('tingkat');
            $table->string('nama_pendidikan');
            $table->string('tahun_lulus');
            $table->enum('status',['Aktif', 'Non Aktif']);
            $table->mediumText('surat_keputusan');
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
        Schema::dropIfExists('pendidikans');
    }
}

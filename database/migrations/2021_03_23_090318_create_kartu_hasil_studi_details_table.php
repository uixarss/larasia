<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuHasilStudiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_hasil_studi_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kartu_hasil_studi_id'); //reference ke khs
            $table->unsignedBigInteger('mapel_id'); // mata kuliah di kampus
            $table->string('mutu')->nullable(); // A,B,C,D
            $table->decimal('nilai', 8, 2)->nullable(); // nilai 4 , 3.5 , 3.0
            $table->unsignedBigInteger('id_dosen')->nullable(); // dosen pengampu
            $table->string('disetujui_oleh')->nullable(); // disetujui oleh prodi
            $table->string('diubah_oleh')->nullable(); // diubah oleh prodi
            $table->string('keterangan')->nullable(); // 
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
        Schema::dropIfExists('kartu_hasil_studi_details');
    }
}

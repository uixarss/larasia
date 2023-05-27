<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gajiable_id');
            $table->string('gajiable_type');
            $table->date('tanggal');
            $table->decimal('jumlah_gaji', 13,2);
            $table->enum('status',['Aktif', 'Non Aktif']);
            $table->date('tanggal_kenaikan_gaji')->nullable();
            $table->decimal('jumlah_kenaikan_gaji', 13,2)->nullable();
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
        Schema::dropIfExists('gajis');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_rpp');
            $table->string('bab');
            $table->mediumText('judul');
            $table->longText('deskripsi')->nullable();
            $table->unsignedBigInteger('created_by');

            $table->foreign('created_by')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('rpps');
    }
}

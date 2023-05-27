<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_nilais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_grade_nilai')->unique();
            $table->string('nama_grade');
            $table->decimal('nilai_rendah');
            $table->decimal('nilai_tinggi');
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
        Schema::dropIfExists('grade_nilais');
    }
}

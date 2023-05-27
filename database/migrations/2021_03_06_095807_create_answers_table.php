<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('siswa_id');
            $table->longText('jawaban');
            // $table->boolean('is_correct')->default(0);

            $table->foreign('quiz_id')
            ->references('id')->on('quizzes')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('question_id')
            ->references('id')->on('questions')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('option_id')
            ->references('id')->on('options')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('siswa_id')
            ->references('id')->on('mahasiswa')
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
        Schema::dropIfExists('answers');
    }
}

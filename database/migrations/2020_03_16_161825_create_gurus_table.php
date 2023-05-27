<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->string('NIP', 50)->unique();
            $table->string('nama_lengkap');
            $table->string('email', 100)->unique()->nullable();
            $table->string('agama')->nullable();
            $table->string('tanggal_lahir', 10)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('phone_no', 15)->nullable();
            $table->longText('alamat')->nullable();
            $table->string('bagian_pegawai')->nullable();
            $table->string('jabatan_pegawai')->nullable();
            $table->string('status_pegawai')->nullable();
            $table->string('tanggal_masuk', 10)->nullable();
            $table->string('photo')->nullable();
            $table->float('honor_pegawai')->nullable();
            $table->enum('status', [0, 1])->default(1);

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('mapel_id')
                ->references('id')->on('mapel')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->softDeletes();


            $table->rememberToken();
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
        Schema::dropIfExists('gurus');
    }
}

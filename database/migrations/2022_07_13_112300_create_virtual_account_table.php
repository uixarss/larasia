<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_account', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_id');
            $table->string('trx_id');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_name');
            $table->string('type');
            $table->string('billing_type');
            $table->string('virtual_account');
            $table->decimal('trx_amount');
            $table->dateTime('datetime_expired');
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('virtual_account');
    }
}

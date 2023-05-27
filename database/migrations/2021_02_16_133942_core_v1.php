<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoreV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Department
        Schema::create('departments', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('nama');
            $table->integer('parent_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        // Bills
        // Schema::create('bills', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('department_id');
        //     $table->string('bill_number');
        //     $table->string('order_number')->nullable();
        //     $table->string('bill_status_code');
        //     $table->dateTime('billed_at');
        //     $table->dateTime('due_at');
        //     $table->double('amount', 15, 2);
        //     $table->string('vendor_name');
        //     $table->string('vendor_email')->nullable();
        //     $table->string('vendor_tax_number')->nullable();
        //     $table->string('vendor_phone')->nullable();
        //     $table->text('vendor_address')->nullable();
        //     $table->text('notes')->nullable();
        //     $table->integer('parent_id')->default(0);
        //     $table->timestamps();
        //     $table->softDeletes();
        //     $table->index('department_id');
        //     $table->unique(['department_id', 'bill_number', 'deleted_at']);
        // });

        // Schema::create('bill_histories', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('department_id');
        //     $table->integer('bill_id');
        //     $table->string('status_code');
        //     $table->boolean('notify');
        //     $table->text('description')->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();

        //     $table->index('department_id');
        // });

        // Schema::create('bill_items', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('department_id');
        //     $table->integer('bill_id');
        //     $table->integer('item_id')->nullable();
        //     $table->string('name');
        //     $table->double('quantity', 7, 2);
        //     $table->double('price', 15, 4);
        //     $table->double('total', 15, 4);
        //     $table->float('tax', 15, 4)->default('0.0000');
        //     $table->timestamps();
        //     $table->softDeletes();

        //     $table->index('department_id');
        // });
        // Schema::create('bill_item_taxes', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('department_id');
        //     $table->integer('bill_id');
        //     $table->integer('bill_item_id');
        //     $table->integer('tax_id');
        //     $table->string('name');
        //     $table->double('amount', 15, 4)->default('0.0000');
        //     $table->timestamps();
        //     $table->softDeletes();

        //     $table->index('department_id');
        // });

        // Schema::create('bill_statuses', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('department_id');
        //     $table->string('name');
        //     $table->string('code');
        //     $table->timestamps();
        //     $table->softDeletes();

        //     $table->index('department_id');
        // });

        // Schema::create('bill_totals', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('department_id');
        //     $table->integer('bill_id');
        //     $table->string('code')->nullable();
        //     $table->string('name');
        //     $table->double('amount', 15, 4);
        //     $table->integer('sort_order');
        //     $table->timestamps();
        //     $table->softDeletes();

        //     $table->index('department_id');
        // });

        // Invoices
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->string('invoice_number');
            $table->string('order_number')->nullable();
            $table->string('invoice_status_code');
            $table->dateTime('invoiced_at');
            $table->dateTime('due_at');
            $table->double('amount', 15, 4);
            $table->integer('customer_id');
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_tax_number')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
            $table->text('notes')->nullable();
            $table->integer('parent_id')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('department_id');
            $table->unique(['department_id', 'invoice_number', 'deleted_at']);
        });

        Schema::create('invoice_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->integer('invoice_id');
            $table->string('status_code');
            $table->boolean('notify');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('department_id');
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->integer('invoice_id');
            $table->integer('item_id')->nullable();
            $table->string('name');
            $table->string('sku')->nullable();
            $table->double('quantity', 7, 2);
            $table->double('price', 15, 4);
            $table->double('total', 15, 4);
            $table->double('tax', 15, 4)->default('0.0000');
            $table->timestamps();
            $table->softDeletes();

            $table->index('department_id');
        });

        Schema::create('invoice_item_taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->integer('invoice_id');
            $table->integer('invoice_item_id');
            $table->integer('tax_id');
            $table->string('name');
            $table->double('amount', 15, 4)->default('0.0000');
            $table->timestamps();
            $table->softDeletes();

            $table->index('department_id');
        });

        Schema::create('invoice_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->string('name');
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();

            $table->index('department_id');
        });

        Schema::create('invoice_totals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->integer('invoice_id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->double('amount', 15, 4);
            $table->integer('sort_order');
            $table->timestamps();
            $table->softDeletes();

            $table->index('department_id');
        });
        // Taxes
        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->string('name');
            $table->double('rate', 15, 4);
            $table->string('type')->default('normal');
            $table->boolean('enabled')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->index('department_id');
        });

        Schema::create('user_department', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('user_type');

            $table->primary(['user_id', 'department_id', 'user_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('departments');
        // Schema::dropIfExists('bills');
        // Schema::dropIfExists('bill_histories');
        // Schema::dropIfExists('bill_items');
        // Schema::dropIfExists('bill_item_taxes');
        // Schema::dropIfExists('bill_statuses');
        // Schema::dropIfExists('bill_totals');
        Schema::dropIfExists('invoice');
        Schema::dropIfExists('invoice_histories');
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoice_item_taxes');
        Schema::dropIfExists('invoice_statuses');
        Schema::dropIfExists('invoice_totals');
        Schema::dropIfExists('taxes');
        Schema::dropIfExists('user_department');
    }
}

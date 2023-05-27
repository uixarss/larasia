<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCoreV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Departments
        Schema::table('departments', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->after('parent_id');
            $table->unsignedBigInteger('updated_by')->after('parent_id');
        });
        // Bills
        // Schema::table('bills', function (Blueprint $table) {
        //     $table->unsignedBigInteger('created_by')->after('parent_id');
        //     $table->unsignedBigInteger('updated_by')->after('parent_id');
        // });
        // Schema::table('bill_histories', function (Blueprint $table) {
        //     $table->unsignedBigInteger('created_by')->after('description');
        //     $table->unsignedBigInteger('updated_by')->after('description');
        // });
        // Schema::table('bill_items', function (Blueprint $table) {
        //     $table->unsignedBigInteger('created_by')->after('tax');
        //     $table->unsignedBigInteger('updated_by')->after('tax');
        // });
        // Schema::table('bill_item_taxes', function (Blueprint $table) {
        //     $table->unsignedBigInteger('created_by')->after('amount');
        //     $table->unsignedBigInteger('updated_by')->after('amount');
        // });
        // Schema::table('bill_statuses', function (Blueprint $table) {
        //     $table->unsignedBigInteger('created_by')->after('code');
        //     $table->unsignedBigInteger('updated_by')->after('code');
        // });
        // Schema::table('bill_totals', function (Blueprint $table) {
        //     $table->unsignedBigInteger('created_by')->after('sort_order');
        //     $table->unsignedBigInteger('updated_by')->after('sort_order');
        // });

        // Invoices 
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->after('parent_id');
            $table->unsignedBigInteger('updated_by')->after('parent_id');
        });
        Schema::table('invoice_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->after('description');
            $table->unsignedBigInteger('updated_by')->after('description');
        });
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->after('tax');
            $table->unsignedBigInteger('updated_by')->after('tax');
        });
        Schema::table('invoice_item_taxes', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->after('amount');
            $table->unsignedBigInteger('updated_by')->after('amount');
        });
        Schema::table('invoice_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->after('code');
            $table->unsignedBigInteger('updated_by')->after('code');
        });
        Schema::table('invoice_totals', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->after('sort_order');
            $table->unsignedBigInteger('updated_by')->after('sort_order');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->text('note')->nullable();
            $table->string('purchase_date');
            $table->float('sub_total',20,2);
            $table->string('vat_in')->comment('Flat,Percentage')->nullable();
            $table->float('vat',20,2)->nullable();
            $table->string('discount_in')->comment('Flat,Percentage');
            $table->float('discount',20,2)->nullable();
            $table->text('discount_note')->nullable();
            $table->float('total_payable',20,2);
            $table->float('cash_given',20,2);
            $table->float('change',20,2);
            $table->float('due',20,2);
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
        Schema::dropIfExists('purchase_invoices');
    }
}

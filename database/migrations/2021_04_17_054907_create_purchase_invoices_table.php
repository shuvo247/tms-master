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
            $table->text('note');
            $table->string('purchase_date');
            $table->integer('purchase_id');
            $table->float('sub_total');
            $table->string('vat_in')->comment('Flat,Percentage');
            $table->float('vat');
            $table->string('discount_in')->comment('Flat,Percentage');
            $table->float('discount');
            $table->text('discount_note');
            $table->float('total_payable');
            $table->float('cash_given');
            $table->float('change');
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

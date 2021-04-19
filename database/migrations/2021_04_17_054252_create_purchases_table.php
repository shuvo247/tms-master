<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('variant_id');
            $table->string('variant_value_id');
            $table->float('purchase_box');
            $table->float('purchase_pcs');
            $table->float('purchase_qty_in_sft');
            $table->float('purchase_rate');
            $table->text('discount_type')->comment('Flat, Percentage');
            $table->float('discount');
            $table->float('total');
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
        Schema::dropIfExists('purchases');
    }
}

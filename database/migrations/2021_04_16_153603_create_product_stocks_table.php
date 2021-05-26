<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('sku')->nullable();
            $table->float('purchase_price');
            $table->float('selling_price');
            $table->float('qty_in_sft');
            $table->float('barcode')->nullable();
            $table->float('sft_in_a_box')->nullable();
            $table->float('sft_in_a_pcs')->nullable();
            $table->float('total_box_sell')->nullable();
            $table->float('total_pcs_sell')->nullable();
            $table->float('total_sft_sell')->nullable();
            $table->float('total_available_box')->nullable();
            $table->float('total_available_pcs')->nullable();
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
        Schema::dropIfExists('product_stocks');
    }
}

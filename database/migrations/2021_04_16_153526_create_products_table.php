<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->string('product_name');
            $table->integer('added_by');
            $table->string('image')->nullable();
            $table->float('pcs_per_box');
            $table->float('purchase_price');
            $table->float('sell_price');
            $table->integer('product_variant')->comment('1 = Yes, 0 = No');
            $table->float('low_stock_qty_in_box');
            $table->float('qty_in_sft');
            $table->integer('num_of_sell');
            $table->string('slug');
            $table->string('barcode');
            $table->float('total_sft_sell');
            $table->float('total_box_sell');
            $table->float('total_qty_in_sft');
            $table->integer('purchase_from');
            $table->integer('payment_method_id');
            $table->integer('unit_id');
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
        Schema::dropIfExists('products');
    }
}

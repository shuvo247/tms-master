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
            $table->integer('attribute_id');
            $table->string('attribute_value');
            $table->string('sku');
            $table->float('purchase_price');
            $table->float('selling_price');
            $table->float('qty_in_sft');
            $table->float('sft_sell');
            $table->float('box_sell');
            $table->float('barcode');
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

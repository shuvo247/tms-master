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
            $table->float('purchase_price',20,2);
            $table->float('selling_price',20,2);
            $table->float('qty_in_sft',20,2);
            $table->float('barcode',20,2)->nullable();
            $table->float('sft_in_a_box',20,2)->nullable();
            $table->float('sft_in_a_pcs',20,2)->nullable();
            $table->float('total_box_sell',20,2)->nullable();
            $table->float('total_pcs_sell',20,2)->nullable();
            $table->float('total_sft_sell',20,2)->nullable();
            $table->float('total_available_box',20,2)->nullable();
            $table->float('total_available_pcs',20,2)->nullable();
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

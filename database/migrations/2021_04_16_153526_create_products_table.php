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
            $table->integer('added_by')->nullable();
            $table->string('product_name');
            $table->string('image')->nullable();
            $table->integer('product_variant')->comment('1 = Yes, 0 = No');            
            $table->integer('pcs_per_box')->nullable();
            $table->integer('alert_qty')->nullable();
            $table->float('total_sft_sell',20,2)->nullable();
            $table->float('total_box_sell',20,2)->nullable();
            $table->float('total_pcs_sell',20,2)->nullable();
            $table->float('total_qty_in_sft',20,2)->nullable()->comment('If product have variant');
            $table->integer('status')->default('1');
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

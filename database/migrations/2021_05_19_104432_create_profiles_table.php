<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('product_stock_id')->nullable();
            $table->integer('variable_product_stock_id')->nullable();
            $table->float('unit_purchase_price',20,2)->nullable();
            $table->float('unit_sell_price',20,2)->nullable();
            $table->float('total_purchase_sft',20,2)->nullable();
            $table->float('total_sell_sft',20,2)->nullable();
            $table->float('total_purchase_price',20,2)->nullable();
            $table->float('total_sell_price',20,2)->nullable();
            $table->float('profit',20,2)->nullable();
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
        Schema::dropIfExists('profiles');
    }
}

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
            $table->string('product_size_id')->nullable();
            $table->string('product_grade_id')->nullable();
            $table->float('purchase_box')->nullable();
            $table->float('purchase_pcs')->nullable();
            $table->float('purchase_qty_in_sft');
            $table->float('purchase_rate');
            $table->text('discount_type')->comment('Flat, Percentage');
            $table->float('discount');
            $table->float('total');
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
        Schema::dropIfExists('purchases');
    }
}

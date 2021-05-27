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
            $table->float('purchase_box',20,2)->nullable();
            $table->float('purchase_pcs',20,2)->nullable();
            $table->float('purchase_qty_in_sft',20,2);
            $table->float('purchase_rate',20,2);
            $table->text('discount_type')->comment('Flat, Percentage');
            $table->float('discount',20,2);
            $table->float('total',20,2);
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDamagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('damages', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->text('note');
            $table->integer('product_id')->comment('Here will be product ID or product stock ID');
            $table->string('variant_id')->nullable();
            $table->string('variant_value_id')->nullable();
            $table->float('damaged_box',20,2);
            $table->float('damaged_pcs',20,2);
            $table->float('damage_qty_in_sft',20,2);
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
        Schema::dropIfExists('damages');
    }
}

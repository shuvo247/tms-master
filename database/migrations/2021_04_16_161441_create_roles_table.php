<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->integer('sales')->comment('1 = yes, 2 = no');
            $table->integer('purchase')->comment('1 = yes, 2 = no');
            $table->integer('accounts')->comment('1 = yes, 2 = no');
            $table->integer('messaging')->comment('1 = yes, 2 = no');
            $table->integer('report')->comment('1 = yes, 2 = no');
            $table->integer('product')->comment('1 = yes, 2 = no');
            $table->integer('register')->comment('1 = yes, 2 = no');
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
        Schema::dropIfExists('roles');
    }
}

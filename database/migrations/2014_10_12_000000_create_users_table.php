<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->nullable();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('phone_number')->nullable();
            $table->integer('alternative_phone_number')->nullable();
            $table->integer('nid_card')->nullable();
            $table->string('joining_date')->nullable();
            $table->float('salary')->nullable();
            $table->string('image')->nullable();
            $table->string('certificate')->nullable();
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
        Schema::dropIfExists('users');
    }
}

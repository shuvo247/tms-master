<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('sms_type_id');
            $table->integer('contact_category')->comment('1 = Customer, 2 = Supplier, 3 = Employee , 4 = Phone Book');
            $table->longText('contact_persons_id')->comment('This will be an array. It will store customer, supplier, employee , phone book ID');
            $table->string('message_type')->comment('masking or non-masking');
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
        Schema::dropIfExists('send_messages');
    }
}

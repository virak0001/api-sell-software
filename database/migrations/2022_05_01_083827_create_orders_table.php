<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number');
            $table->integer('order_total_amount');
            $table->integer('transaction_id');
            $table->string('order_status');
            $table->string('email');
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('customer_city');
            $table->integer('customer_pin');
            $table->string('customer_state');
            $table->string('customer_country');
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
        Schema::dropIfExists('orders');
    }
}

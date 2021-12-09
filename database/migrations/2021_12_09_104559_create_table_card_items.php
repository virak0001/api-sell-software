<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCardItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_card_items', function (Blueprint $table) {
            $table->unsignedBigInteger('card_id')->nullable(false);
            $table->foreign('card_id')
            ->references('id')
            ->on('cards');
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->foreign('product_id')
            ->references('id')
            ->on('prodcuts');
            $table->double('quantity');
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
        Schema::dropIfExists('table_card_items');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sid')->unsigned();
            $table->foreign('sid')->references('account_id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('uid')->unsigned();
            $table->foreign('uid')->references('account_id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('pid')->unsigned();
            $table->foreign('pid')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->string('product_name'); //varchar(255)
            $table->integer('product_qty'); //varchar(255)
            $table->integer('total_price'); //varchar(255)
            $table->string('product_photo'); //varchar(255)
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
        Schema::dropIfExists('order_details');
    }
}

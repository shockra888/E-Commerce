<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

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
            $table->increments('orderid');

            $table->integer('sid')->unsigned();
            $table->foreign('sid')->references('account_id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('pid')->unsigned();
            $table->foreign('pid')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('AccntID')->unsigned();
            $table->foreign('AccntID')->references('account_id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('customer_name'); //varchar(255)
            $table->string('customer_Address'); //varchar(255)
            $table->string('Customer_Contact'); //varchar(255)
            $table->string('product_name'); //varchar(255)
            $table->integer('product_qty'); //varchar(255)
            $table->integer('total_price'); //varchar(255)
            $table->integer('total_pay')->nullable();
            $table->string('status'); //varchar(255)
            $table->string('date_of_order');
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

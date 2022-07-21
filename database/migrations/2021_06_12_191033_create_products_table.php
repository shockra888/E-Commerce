<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplierID')->unsigned();
            $table->foreign('supplierID')->references('account_id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('Category'); //varchar(255)
            $table->string('product_name'); //varchar(255)
            $table->integer('product_price'); //varchar(255)
            $table->integer('product_qty'); //varchar(255);
            $table->string('product_details');
            $table->string('product_image');
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
        Schema::dropIfExists('products');
    }
}

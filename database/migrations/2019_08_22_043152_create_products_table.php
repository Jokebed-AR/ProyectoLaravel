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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('sku')->nullable();
            $table->integer('quantity')->default(0);
            $table->float('normal_price');
            $table->float('price_tax');
            $table->text('description')->nullable();
            $table->text('resum')->nullable();
            $table->float('discount')->nullable();
            $table->float('discount_delivery')->nullable();
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('url');
            $table->string('redirect')->nullable();
            $table->float('rating')->default(5);

            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->bigInteger('free_accessory_id')->unsigned()->nullable();
            $table->foreign('free_accessory_id')->references('id')->on('products');

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

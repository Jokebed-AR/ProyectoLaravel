<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('attended_by')->unsigned()->nullable();
            $table->foreign('attended_by')->references('id')->on('users');
            $table->enum('status', ['created', 'payed', 'delivered', 'cancelled', 'sent'])->default('created');
            $table->double('total');
            $table->double('subtotal');
            $table->bigInteger('payment_id')->unsigned()->nullable();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->bigInteger('address_id')->unsigned();
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->bigInteger('transport_id')->unsigned();
            $table->foreign('transport_id')->references('id')->on('transports');
            $table->softDeletes();
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

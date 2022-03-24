<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section');
            $table->text('notify_to')->nullable();
            $table->integer('period');
            $table->integer('every');
            $table->text('message')->nullable();
            $table->boolean('receive_call')->default(0);
            $table->bigInteger('form_id')->unsigned();
            $table->foreign('form_id')->references('id')->on('forms');
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
        Schema::dropIfExists('data_collections');
    }
}

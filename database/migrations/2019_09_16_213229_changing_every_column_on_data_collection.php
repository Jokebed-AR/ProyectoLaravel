<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangingEveryColumnOnDataCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_collections', function (Blueprint $table) {
            $table->dropColumn('every');
        });
        Schema::table('data_collections', function (Blueprint $table) {
            //
            $table->enum('every', ['day', 'month', 'week', 'minute', 'hour', 'session']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_collections', function (Blueprint $table) {
            //
        });
    }
}

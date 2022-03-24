<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletingRequiredFormInCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_collections', function (Blueprint $table) {
            $table->dropForeign('data_collections_form_id_foreign');
            $table->bigInteger('form_id')->unsigned()->nullable()->change();
        });

        Schema::table('data_collections', function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on('forms');
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

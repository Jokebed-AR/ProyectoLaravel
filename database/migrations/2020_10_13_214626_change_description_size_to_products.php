<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDescriptionSizeToProducts extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->mediumText('description')->nullable()->change();
            $table->mediumText('resum')->nullable()->change();
        });

        Schema::table('action_events', function (Blueprint $table) {
            $table->mediumText('changes')->nullable()->change();
        });
    }

    public function down()
    {

    }

}

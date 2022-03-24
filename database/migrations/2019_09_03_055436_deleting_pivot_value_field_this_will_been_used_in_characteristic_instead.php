<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletingPivotValueFieldThisWillBeenUsedInCharacteristicInstead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characteristic_product', function (Blueprint $table) {
            $table->dropColumn('value');
        });

        Schema::table('characteristics', function (Blueprint $table) {
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dont_use_it_in_product_characteristic', function (Blueprint $table) {
            //
        });
    }
}

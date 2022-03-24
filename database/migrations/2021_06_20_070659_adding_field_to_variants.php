<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingFieldToVariants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variant_options', function (Blueprint $table) {
            $table->string('option_name')->default('');
            $table->string('attribute_name')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_variant_options', function (Blueprint $table) {
            $table->dropColumn('option_name');
            $table->dropColumn('attribute_name');
        });
    }
}

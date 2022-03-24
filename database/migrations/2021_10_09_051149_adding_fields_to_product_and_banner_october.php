<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddingFieldsToProductAndBannerOctober extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->integer('sort_order');
            $table->boolean('is_active')->default(1);
        });

        DB::statement('UPDATE banners SET sort_order = id');

        Schema::table('products', function (Blueprint $table) {
            $table->boolean('show_in_home')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('sort_order');
            $table->dropColumn('is_active');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('show_in_home');
        });
    }
}

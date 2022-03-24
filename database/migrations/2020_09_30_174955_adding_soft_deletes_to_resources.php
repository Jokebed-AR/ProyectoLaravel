<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingSoftDeletesToResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('classifications', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->string('logo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('classifications', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn('logo');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddingColumnsToCatalogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->json('video_urls')->nullable();
            $table->json('questions')->nullable();
            $table->json('measures')->nullable();
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->json('video_urls')->nullable();
            $table->json('questions')->nullable();
            $table->json('measures')->nullable();
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->json('video_urls')->nullable();
            $table->json('questions')->nullable();
            $table->json('measures')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('video_urls');
            $table->dropColumn('questions');
            $table->dropColumn('measures');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn('video_urls');
            $table->dropColumn('questions');
            $table->dropColumn('measures');
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('video_urls');
            $table->dropColumn('questions');
            $table->dropColumn('measures');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddingTitlesToCatalogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('gallery_title')->default('Galería');
            $table->string('faq_title')->default('Preguntas Frecuentes');
            $table->string('video_title')->default('Videos');
            $table->string('extra_title')->default('Extras');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->string('gallery_title')->default('Galería');
            $table->string('faq_title')->default('Preguntas Frecuentes');
            $table->string('video_title')->default('Videos');
            $table->string('extra_title')->default('Extras');
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->string('gallery_title')->default('Galería');
            $table->string('faq_title')->default('Preguntas Frecuentes');
            $table->string('video_title')->default('Videos');
            $table->string('extra_title')->default('Extras');
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
            $table->dropColumn('gallery_title');
            $table->dropColumn('faq_title');
            $table->dropColumn('video_title');
            $table->dropColumn('extra_title');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn('gallery_title');
            $table->dropColumn('faq_title');
            $table->dropColumn('video_title');
            $table->dropColumn('extra_title');
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('gallery_title');
            $table->dropColumn('faq_title');
            $table->dropColumn('video_title');
            $table->dropColumn('extra_title');
        });
    }
}

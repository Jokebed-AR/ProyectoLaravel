<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('seo_name')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->longText('description_1')->nullable();
            $table->longText('description_2')->nullable();
            $table->boolean('has_form')->default(0);
            $table->boolean('testimonials')->default(0);
            $table->json('video_urls')->nullable();
            $table->string('form_title')->nullable();
            $table->string('related_products_title')->nullable();
            $table->string('videos_title')->nullable();
            $table->string('testimonials_title')->nullable();

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
        Schema::dropIfExists('landing_pages');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LandingPage extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'seo_name', 'description_1', 'description_2', 'has_form', 'meta_title', 'meta_description',
        'testimonials', 'video_urls', 'form_title', 'related_products_title', 'videos_title', 'testimonials_title'
    ];

    public $casts = [
        'video_urls' => 'array'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(350)
            ->height(350);

        $this->addMediaCollection('image_1')->singleFile();
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'landing_page_products')->orderBy('name');
    }
}

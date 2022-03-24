<?php

namespace App\Models;

use App\Helpers\LaravelMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Product extends Model implements HasMedia, Sortable
{

    use InteractsWithMedia,
        SoftDeletes, SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    public $casts = [
        'video_urls' => 'array'
    ];

    // BelongsTo
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // BelongsToMany
    public function characteristics()
    {
        return $this->belongsToMany(Characteristic::class)->using(ProductCharacteristic::class);
    }

    // HasMany
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function free_accesory()
    {
        return $this->hasMany(Product::class, 'free_accesory_id');
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(130)
            ->height(130);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')->singleFile();
        $this->addMediaCollection('my_multi_collection');
    }

    public function getImage()
    {
        return LaravelMedia::getImage($this, 'products');
    }

    public function getImages()
    {
        return LaravelMedia::getImages($this, 'products');
    }

    public function getVideos()
    {
        $mediaVideos = LaravelMedia::getVideos($this, 'videos');
        $modelVideos = $this->video_urls;
        $mediaVideos = ($mediaVideos == null) ? [] : $mediaVideos;
        $modelVideos = ($modelVideos == null) ? [] : $modelVideos;
        return array_merge($mediaVideos, $modelVideos);

    }

    public function getDocuments()
    {
        return LaravelMedia::getDocuments($this, 'documentos');
    }

    public function getDocumentsByName()
    {
        return LaravelMedia::getDocumentsByName($this);
    }

    public function getUrl()
    {
        if ($this->subcategory == null) {
            $url = 'detalle/' . $this->category->url . '/no-subcategoria/' . $this->url;
        } else {
            $url = 'detalle/' . $this->category->url . '/' . $this->subcategory->url . '/' . $this->url;
        }
        return $url;
    }

    public function getButtonColor()
    {
        $color = 'bg-primary';
        if (isset($this->category->classification))
            if (strpos($this->category->classification->name, 'lico') !== false)
                $color = 'bg-secondary-900';
        return $color;
    }

    public function getTextColor()
    {
        $color = 'text-secondary-900';
        if (isset($this->category->classification))
            if (strpos($this->category->classification->name, 'lico') !== false)
                $color = 'text-primary';
        return $color;
    }

    public function getVariants()
    {
        return ProductVariant::where('product_id', $this->id)->with('options')->get();
    }

    public function optionsSelected()
    {
        $variantIds = ProductVariant::where('product_id', $this->id)->pluck('id')->toArray();
        return ProductVariantOption::whereIn('product_variant_id', $variantIds)->groupBy('option_id')->get();
    }
}

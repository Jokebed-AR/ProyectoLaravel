<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements Sortable, HasMedia
{

    use SoftDeletes, SortableTrait, InteractsWithMedia;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true
    ];

    public $casts = [
        'video_urls' => 'array',
        'measures' => 'array',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function getImage()
    {
        if ($this->image !== null && $this->image !== '') {
            return 'https://tecnotanques.s3-us-east-2.amazonaws.com/' . $this->image;
        } else {
            return '';
        }
    }

    public function getLogo()
    {
        if ($this->logo !== null && $this->logo !== '') {
            return 'https://tecnotanques.s3-us-east-2.amazonaws.com/' . $this->logo;
        } else {
            return '/img/tecnotanques/NotFound.png';
        }
    }

    public function productImage()
    {
        $products = $this->products;
        return count($products) == 0 ? $this->getImage() : $products[0]->getImage();
    }

    public function productImage64()
    {
        $products = $this->products;
        $image =  count($products) == 0 ? $this->getImage() : $products[0]->getImage();
        $file_headers = @get_headers($image);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 403 Forbidden') {
            $image = env('APP_URL').'/img/tecnotanques/NotFound.png';
        }

        $type   = pathinfo($image, PATHINFO_EXTENSION);
        $data   = file_get_contents($image);
        $base64 = 'data:application/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    public function productUrl()
    {
        $products = $this->products;
        return count($products) == 0 ? $this->getImage() : $products[0]->getUrl();
    }

    public function getButtonColor()
    {
        $color = 'bg-primary';
        if (isset($this->classification))
            if (strpos($this->classification->name, 'lico') !== false)
                $color = 'bg-secondary-900';
        return $color;
    }

    public function getTextColor()
    {
        $color = 'text-secondary-900';
        if (isset($this->classification))
            if (strpos($this->classification->name, 'lico') !== false)
                $color = 'text-primary';
        return $color;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(350)
            ->height(350);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main')->singleFile();
        $this->addMediaCollection('category_images');
    }
}

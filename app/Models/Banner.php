<?php

namespace App\Models;

use App\Helpers\LaravelMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\EloquentSortable\SortableTrait;

class Banner extends Model implements HasMedia, Sortable
{
    use SoftDeletes, InteractsWithMedia, SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('image')
            ->width(130)
            ->height(130);
    }

    public function getImageDesktop()
    {
        return LaravelMedia::getImage($this, 'image-desktop');
    }

    public function getImageMobile()
    {
        $image = LaravelMedia::getImage($this, 'image-mobile');
        return ($image == null || $image == '') ? LaravelMedia::getImage($this, 'image-mobile') : $image;
    }
}

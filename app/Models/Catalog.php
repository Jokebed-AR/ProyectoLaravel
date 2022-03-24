<?php

namespace App\Models;

use App\Helpers\LaravelMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Catalog extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'type', 'url'
    ];

    public function catalogDownloads()
    {
        return $this->hasMany('App\Models\CatalogDownload');
    }

    public function getDocuments()
    {
        return LaravelMedia::getDocuments($this, 'archivo');
    }
}

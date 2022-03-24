<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogDownload extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'catalog_id'
    ];

    public function catalog()
    {
        return $this->belongsTo('App\Models\Catalog');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
    ];

    // HasMany
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function productVariantOptions()
    {
        return $this->hasMany(ProductVariantOption::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'attribute_id'
    ];

    // BelongsTo
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    // HasMany
    public function productVariantOptions()
    {
        return $this->hasMany(ProductVariantOption::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'normal_price', 'price_tax', 'discount', 'stock', 'product_id', 'default'
    ];

    // BelongsTo
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // HasMany
    public function options()
    {
        return $this->hasMany(ProductVariantOption::class);
    }
}

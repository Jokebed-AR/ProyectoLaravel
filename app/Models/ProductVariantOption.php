<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantOption extends Model
{
    protected $fillable = [
        'option_id', 'product_variant_id', 'attribute_id', 'option_name', 'attribute_name'
    ];

    // BelongsTo
    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}

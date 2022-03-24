<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductContact extends Model
{
    protected $fillable = [
        'product_id', 'contact_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

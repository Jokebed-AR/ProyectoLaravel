<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}

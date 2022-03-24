<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'phone', 'cellphone',
        'shipping_place', 'substance_to_store',
        'quantity', 'message', 'capacity', 'sector'
    ];

    public function products() {
        return $this->belongsToMany('App\Models\Product', 'product_contacts');
    }
}

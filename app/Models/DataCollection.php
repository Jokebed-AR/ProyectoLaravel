<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataCollection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section', 'form_id', 'period', 'every'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}

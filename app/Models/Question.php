<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ofcold\NovaSortable\SortableTrait;

class Question extends Model
{

    use SoftDeletes;

    use SortableTrait;

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}

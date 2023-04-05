<?php

namespace App\Models;

use App\Models\Size;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{

    protected $guarded = [] ;

    public function size()
    {
        return $this->belongsToMany(Size::class);
    }

}

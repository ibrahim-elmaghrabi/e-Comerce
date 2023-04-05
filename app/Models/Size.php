<?php

namespace App\Models;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{

    protected $guarded = [] ;

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}

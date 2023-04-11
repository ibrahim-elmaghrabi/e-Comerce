<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [] ;

    public function setValueAttribute($value)
    {
        if ($this->attributes['type'] == 'percentage') {
            $value = $value / 100 ;
        }
        $this->attributes['value'] = $value;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}

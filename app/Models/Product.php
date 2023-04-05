<?php

namespace App\Models;

use App\Models\{Size, User, Image, Order, Store, Comment, Category};
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [] ;

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorey()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}

<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\{Size, User, Image, Order, Store, Comment, Category,};

class Product extends Model  implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['id', 'created_at', 'updated_at'] ;

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

    public function category()
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

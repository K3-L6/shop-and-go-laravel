<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function brand()
    {
    	return $this->belongsTo(Brand::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function productimage()
    {
    	return $this->hasMany(Productimage::class);
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function productspecification()
    {
        return $this->hasMany(Productspecification::class);
    }

    public function showcaseitem()
    {
        return $this->hasMany(Showcaseitem::class);
    }

    public function cartitem()
    {
        return $this->hasMany(Cartitem::class);
    }

    public function orderitem()
    {
        return $this->hasMany(Orderitem::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }
}

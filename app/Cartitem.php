<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartitem extends Model
{
    public $timestamps = false;

    public function cart()
    {
    	return $this->belongsTo(Cart::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productimage extends Model
{
    public $timestamps = false;

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}

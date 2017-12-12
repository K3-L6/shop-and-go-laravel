<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productspecification extends Model
{
    public $timestamps = false;

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}

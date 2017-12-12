<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Showcaseitem extends Model
{
    public $timestamps = false;

    public function showcaseitem()
    {
    	return $this->belongsTo(Showcase::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}

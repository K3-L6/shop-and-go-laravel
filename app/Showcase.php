<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{
    public function showcaseitem()
    {
    	return $this->hasMany(Showcaseitem::class);
    }
}

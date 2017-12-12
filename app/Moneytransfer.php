<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moneytransfer extends Model
{
    public $timestamps = false;

    public function moneytransferpending()
    {
    	return $this->hasMany(Moneytransferpending::class);
    }
}

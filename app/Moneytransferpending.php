<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moneytransferpending extends Model
{
    public $timestamps = false;

    public function moneytransfer()
    {
    	return $this->belongsTo(Moneytransfer::class);
    }
}

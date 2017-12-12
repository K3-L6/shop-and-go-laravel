<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function cartitem()
	{
		return $this->hasMany(Cartitem::class);
	}
}

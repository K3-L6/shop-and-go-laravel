<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    public $timestamps = false;

    public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function cancelproductrequest()
	{
	    return $this->hasMany(Cancelproductrequest::class);
	}

	public function returnproductrequest()
	{
	    return $this->hasMany(Returnproductrequest::class);
	}
}

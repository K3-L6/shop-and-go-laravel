<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;

    public function user()
    {
    	return $this->hasMany(User::class);
    }

    public function archiveuser()
    {
    	return $this->hasMany(Archiveuser::class);
    }
}

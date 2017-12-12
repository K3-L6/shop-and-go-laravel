<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archiveuser extends Model
{

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

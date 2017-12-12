<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname', 'firstname', 'mobilenumber', 'address', 'email', 'password', 'avatar', 'verifyToken', 'province_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function cancelrequest()
    {
        return $this->hasMany(Cancelrequest::class);
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

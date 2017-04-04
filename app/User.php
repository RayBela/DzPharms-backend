<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /*defining relationships*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * get the user addresses
     */

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * get the user favorites
     */

    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *
     * get the pharmacy associated to the user
     */

    public function Pharmacy()
    {
        return $this->hasOne('App\Pharmacy');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

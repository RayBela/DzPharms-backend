<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pharmacy extends Model
{
    //protected $table = 'pharmacies';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * get the schedules for the pharmacy
     */

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * a pharmacy is a favorite for multiple users
     *
     */

    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Get the user that owns the pharmacy.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }



}

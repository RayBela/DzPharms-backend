<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * get the parent user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

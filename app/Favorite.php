<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * get the parent pharmacy
     */
    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }


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

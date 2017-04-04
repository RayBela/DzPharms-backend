<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
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
}

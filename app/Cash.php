<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    /**
     * Get the user who entered this cash flow record.
     */
    public function entered_by()
    {
        return $this->belongsTo('App\User', 'entered_by');

    }
}
